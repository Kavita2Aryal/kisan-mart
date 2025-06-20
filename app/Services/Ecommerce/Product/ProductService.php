<?php

namespace App\Services\Ecommerce\Product;

use App\Models\Cms\WebAlias;
use App\Models\Ecommerce\Brand;
use App\Models\Ecommerce\Category;
use App\Models\Ecommerce\Color;
use App\Models\Ecommerce\ColorGroup;
use App\Services\Cms\WebAliasService;
use App\Services\Ecommerce\Product\ProductVariantService;
use App\Models\Ecommerce\Product\Product;
use App\Models\Ecommerce\Product\ProductCategory;
use App\Models\Ecommerce\Product\ProductComboList;
use App\Models\Ecommerce\Product\ProductImage;
use App\Models\Ecommerce\Product\ProductSeo;
use App\Models\Ecommerce\Product\ProductSizeChartImage;
use App\Models\Ecommerce\Product\ProductVariant;
use App\Models\Ecommerce\Size;
use App\Services\Ecommerce\BrandService;
use App\Services\Ecommerce\CategoryService;
use App\Services\Ecommerce\CollectionService;
use App\Services\Ecommerce\ColorGroupService;
use App\Services\Ecommerce\ColorService;
use App\Services\Ecommerce\ImageUploadService;
use App\Services\Ecommerce\SizeService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

use DB;

class ProductService
{
    public static function _find($uuid)
    {
        return Product::with(['product_categories.category', 'brand', 'alias'])->where('uuid', $uuid)->firstOrFail();
    }

    public static function _get($is_combo_product)
    {
        return ($is_combo_product) ? Product::where('is_combo_product', 10)->orderBy('created_at', 'DESC')->where('is_active', 10)->get() : Product::where('is_combo_product', 0)->orderBy('created_at', 'DESC')->get();
    }

    public static function _paging($req, $is_combo_product)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = Product::with(['product_categories.category', 'brand', 'alias', 'user'])->orderBy('created_at', 'DESC');
        ($is_combo_product) ? $data->where('is_combo_product', 10) : $data->where('is_combo_product', 0);
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req, $combo_product)
    {
        $model = new Product();
        $model->name                    = strtolower($req->name);
        // $model->category_id             = $req->category;
        $model->brand_id                = $req->brand;
        $model->keywords                = $req->seo['meta_keywords'];
        $model->short_description       = trim_description($req->short_description);
        $model->long_description        = trim_description($req->long_description);
        $model->video_url               = $req->video_url;
        $model->is_active               = $req->has('is_active') ? 10 : 0;
        $model->has_variant             = $req->has('has_variant') ? 10 : 0;
        $model->show_qty                = $req->has('show_qty') ? 10 : 0;
        $model->hit_count               = 0;
        $model->purchase_count          = 0;
        $model->is_combo_product        = ($combo_product) ? 10 : 0;

        if ($model->save()) {
            if(str_starts_with($req->alias, 'p/')){
                $alias = $req->alias;
            }else{
                $alias = 'p/'.$req->alias;
            }
            WebAliasService::_storing('product_id', $model->id, $alias);
            if($req->has('categories')){
                self::_save_categories($model->id, $req->categories);
            }
            self::_save_seo($model->id, $req);
            self::_save_thumbnail($model->id, $req->thumbnail);
            if ($req->has('gallery')) {
                self::_save_images($model->id, $req->gallery);
            }
            ProductVariantService::_saving($model->id, $req, $model->has_variant);
            if($req->collections != null)
            {
                CollectionService::_storing_product($req->collections, $model->id);
            }
            if($req->has('products'))
            {
                self::_save_assigned_products($model->id, $req->products);
            }
            return true;
        }
        return false;
    }

    public static function _updating($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        $model->name                    = strtolower($req->name);
        // $model->category_id             = $req->category;
        $model->brand_id                = $req->brand;
        $model->keywords                = $req->seo['meta_keywords'];
        $model->short_description       = trim_description($req->short_description);
        $model->long_description        = trim_description($req->long_description);
        $model->is_active               = $req->has('is_active') ? 10 : 0;
        $model->has_variant             = $req->has('has_variant') ? 10 : 0;
        $model->show_qty                = $req->has('show_qty') ? 10 : 0;
        $model->video_url               = $req->video_url;
        $model->hit_count               = 0;
        $model->purchase_count          = 0;

        if ($model->update()) {
            if(str_starts_with($req->alias, 'p/')){
                $alias = $req->alias;
            }else{
                $alias = 'p/'.$req->alias;
            }
            WebAliasService::_updating('product_id', $model->id, $alias);
            if($req->has('categories')){
                self::_save_categories($model->id, $req->categories);
            }
            self::_save_seo($model->id, $req);
            self::_save_thumbnail($model->id, $req->thumbnail);
            if ($req->has('gallery')) {
                self::_save_images($model->id, $req->gallery);
            }
            ProductVariantService::_updating($model->id, $req, $model->has_variant);
            if($req->collections != null)
            {
                CollectionService::_storing_product($req->collections, $model->id);
            }
            return true;
        }
        return false;
    }

    public static function _change_status($uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return -1;

        $model->is_active = ($model->is_active == 10 ? 0 : 10);
        $model->update();
        return $model->is_active;
    }

    public static function _change_stock_status($uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return -1;

        $model->out_of_stock = ($model->out_of_stock == 10 ? 0 : 10);
        $model->update();
        return $model->out_of_stock;
    }

    public static function _save_categories($id, $categories)
    {
        ProductCategory::where('product_id', $id)->delete();
        if($categories != null)
        {
            foreach ($categories as $row) {
                $batch[] = [
                    'product_id' => $id,
                    'category_id'   => $row,
                ];
            }

            if (isset($batch) && !empty($batch)) {
                ProductCategory::insert($batch);
                return true;
            }
        }
        return false;
    }
    public static function _save_seo($id, $req)
    {
        $seo = ProductSeo::firstOrNew(['product_id' => $id]);
        $seo->product_id        = $id;
        $seo->meta_title        = $req->seo['meta_title'];
        $seo->meta_keywords     = $req->seo['meta_keywords'];
        $seo->meta_description  = $req->seo['meta_description'];
        $seo->image             = $req->thumbnail;
        $seo->image_alt         = $req->seo['image_alt'];
        $seo->save();
    }

    public static function _save_images($id, $data)
    {
        ProductImage::where(['product_id' => $id, 'is_thumb' => 0, 'color_id' => null])->delete();
        if ($data != null) {
            foreach ($data as $img) {
                $batch[] = [
                    'product_id' => $id,
                    'color_id'   => null,
                    'image'      => $img,
                    'is_thumb'   => 0,
                ];
            }

            if (isset($batch) && !empty($batch)) {
                ProductImage::insert($batch);
                return true;
            }
        }
        return false;
    }

    public static function _save_thumbnail($id, $data)
    {
        if ($data != null) {
            $thumb = ProductImage::firstOrNew(['product_id' => $id, 'is_thumb' => 10, 'color_id' => null]);
            if ($thumb->image != $data) {
                ImageUploadService::_remove($thumb->image, 'product');
            }
            $thumb->image = $data;
            $thumb->save();
        }
    }

    public static function _save_assigned_products($id, $data)
    {
        ProductComboList::where('product_id', $id)->delete();
        if($data != null)
        {
            foreach($data as $row)
            {
                $batch[] = [
                    'product_id'    => $id,
                    'product_combo_id'  => $row
                ];
            }
            if (isset($batch) && !empty($batch)) {
                ProductComboList::insert($batch);
                return true;
            }
        }
        return false;
    } 
    public static function _get_variant_details($product)
    {
        $color_image_arr = [];
        $color_id_arr = [];
        $selected_colors = [];
        $selected_sizes = [];
        $mockfiles = [];
        $image_mock = [];
        if ($product->has_variant == 10 && isset($product->variants) && $product->variants != '') {
            foreach ($product->variants as $key => $variation) {
                if(!isset($color_image_arr[$variation->color_id])){
                    if ($variation->images() != null && count($variation->images()) > 0) {
                        $color_id_arr[] = $variation->color_id;
                        $mockfiles[$variation->color_id] = self::_color_images($variation->images(), $image_mock);
                        foreach ($variation->images() as $image) {
                            if ($variation->color_id == $image->color_id) {
                                $color_image_arr[$variation->color_id]['images'][] = $image->image;
                            }
                        }
                    }
                }
                if ($variation->color_id != null) {
                    $c_arr = [
                        'id' => $variation->color_id,
                        'name' => $variation->variant_color->name,
                        'slug' => str_replace(' ', '', $variation->variant_color->name),
                    ];
                    if (!in_array($c_arr, $selected_colors)) {
                        $selected_colors[] = $c_arr;
                    }
                }
                if ($variation->size_id != null) {
                    $s_arr = [
                        'id' => $variation->size_id,
                        'name' => $variation->variant_size->value,
                        'slug' => str_replace(' ', '', $variation->variant_size->value)
                    ];
                    if (!in_array($s_arr, $selected_sizes)) {
                        $selected_sizes[] = $s_arr;
                    }
                }
            }
        }
        return [
            'color_image_arr' => $color_image_arr,
            'color_id_arr' => $color_id_arr,
            'selected_colors' => $selected_colors,
            'selected_sizes' => $selected_sizes,
            'mockfiles' => $mockfiles,
            'image_mock' => $image_mock,
        ];
    }

    public static function _color_images($images, $image_mock)
    {
        foreach ($images as $key => $image) {
            if (Storage::exists('public/product/' . $image->image)) {
                $image_mock[] = [
                    'url' => Storage::url('public/product/' . $image->image),
                    'name' => $image->image,
                    'size' => Storage::size('public/product/' . $image->image)
                ];
            }
        }
        return $image_mock;
    }

    public static function _format_for_csv($data)
    {
        $array_column_heading_names = [
            'A1' => 'Name',
            'B1' => 'Category',
            'C1' => 'Brand',
            'D1' => 'Video Url',
            'E1' => 'Keywords',
            'F1' => 'Short Description',
            'G1' => 'Long Description',
            'H1' => 'Hit Count',
            'I1' => 'Created On',
            'J1' => 'Has Variant',
            'K1' => 'SKU',
            'L1' => 'Color',
            'M1' => 'Size',
            'N1' => 'Qty',
            'O1' => 'Selling Price',
            'P1' => 'Cost Price',
        ];
        $array = [];
        if ($data) {
            $i = 2; // always start this from 1
            foreach ($data as $key => $row) {
                foreach($row->product_categories as $key => $cat){
                    $product_categories[$key] = $cat->category->name;
                }
                $array[$key]['A' . $i] = $row->name;
                $array[$key]['B' . $i] = count($product_categories) > 0 ? implode("|", $product_categories) : '-';
                $array[$key]['C' . $i] = $row->brand->name;
                $array[$key]['D' . $i] = $row->video_url ?? '-';
                $array[$key]['E' . $i] = $row->keywords ?? '-';
                $array[$key]['F' . $i] = $row->short_description ?? '-';
                $array[$key]['G' . $i] = $row->long_description ?? '-'; 
                $array[$key]['H' . $i] = $row->hit_count;
                $array[$key]['I' . $i] = date('Y-m-d H:i:s', strtotime($row->created_at));
                $array[$key]['J' . $i] = $row->has_variant == 10 ? 'yes' : 'no';
                $array[$key]['K' . $i] = $row->default_variant != null ? $row->default_variant->sku : '-';
                $array[$key]['L' . $i] = $row->default_variant != null ? $row->default_variant->variant_color->name ?? '-' : '-';
                $array[$key]['M' . $i] = $row->default_variant != null ? $row->default_variant->variant_size->value ?? '-' : '-';
                $array[$key]['N' . $i] = $row->default_variant != null ? $row->default_variant->qty : '-';
                $array[$key]['O' . $i] = $row->default_variant != null ? $row->default_variant->selling_price ?? '-' : '-';
                $array[$key]['P' . $i] = $row->default_variant != null ? $row->default_variant->cost_price ?? '-' : '-';
                if($row->has_variant == 10 && $row->other_variants != null)
                {
                    $count = count($row->other_variants);
                    $variable_arr = ['sku', 'color', 'size', 'qty', 'selling_price', 'cost_price'];
                    foreach($row->other_variants as $item){
                        $i++;
                        $x = 'K';
                        foreach($variable_arr as $var){
                            if($var == 'color')
                            {
                                $array[0][$x . $i] = $item->variant_color->name ?? '-';
                            }elseif($var == 'size')
                            {
                                $array[0][$x . $i] = $item->variant_size->value ?? '-';
                            }else{
                                $array[0][$x . $i] = $item[$var] ?? '-';
                            }
                            $x++;
                        }
                    }
                }else{
                    $i++;
                }
                
            }
        }
        return ['array_column_heading_names' => $array_column_heading_names, 'array' => $array];
    }

    public static function _excel_upload($req)
    {
        $filenameWithExt = $req->file('excel_file')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = $req->file('excel_file')->getClientOriginalExtension();
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;
        $upload_success = $req->file('excel_file')->storeAs('public/product/excel', $fileNameToStore);

        if ($upload_success) {
            $reader = IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load(storage_path('app/public/product/excel') . '/' . $fileNameToStore);
            $reader->setLoadAllSheets();
            $sheetDatas = $spreadsheet->getAllSheets();
            $sheetNames = $spreadsheet->getSheetNames();
            $sheetData = [];
            foreach ($sheetDatas as $key => $sheetRow) {
                $sheetData[$sheetNames[$key]] = $sheetRow->removeRow(1)->toArray();
            }
            // dd($sheetData);
            self::_storing_excel($sheetData);

            if (Storage::exists('public/product/excel/' . $fileNameToStore)) {
                Storage::delete('public/product/excel/' . $fileNameToStore);
            }

            return $fileNameToStore;
        }
        return false;
    }

    public static function _excel_remove($req)
    {
        if ($req->has('excel_file')) {
            if (Storage::exists('public/product/excel/' . $req->excel_file)) {
                Storage::delete('public/product/excel/' . $req->excel_file);
                return true;
            }
        }
        return false;
    }

    public static function _storing_excel($sheetData)
    {
        $dbcategories     = Category::select('id', DB::raw('LOWER(name) as dname'))->get()->keyBy('dname');
        $brands         = Brand::select('id', DB::raw('LOWER(name) as dname'))->get()->keyBy('dname');
        $sizes          = Size::select('id', DB::raw('LOWER(value) as dname'))->get()->keyBy('dname');
        $base_colors    = ColorGroup::select('id', DB::raw('LOWER(name) as dname'))->get()->keyBy('dname');
        $colors         = Color::select('id', DB::raw('LOWER(name) as dname'))->get()->keyBy('dname');
        foreach ($sheetData as $key => $row) {
            $old_name = '';
            $i = 0;
            foreach ($row as $data) {
                $i++;
                
                $image_link = '';
                $imagelinks = explode(' ', trim($data[1]));
                foreach($imagelinks as $imgl) {
                    $image_link .=  $imgl.' </br> ';
                }

                $product_name   = (isset($data[2]) && $data[2] != null) ? strtolower(trim($data[2])) : null;
                $category       = (isset($data[3]) && $data[3] != null) ? strtolower(trim($data[3])) : null;
                $brand          = (isset($data[4]) && $data[4] != null) ? (isset($brands[strtolower(trim($data[4]))]) ? $brands[strtolower(trim($data[4]))]->id : 'empty') : null;
                $video_url      = (isset($data[5]) && $data[5] != null) ? trim($data[5]) : null;
                $has_variant    = (isset($data[6]) && $data[6] != null) ? ((strtolower(trim($data[6])) == "yes") ? 10 : 0) : 0;
                $base_color     = (isset($data[7]) && $data[7] != null) ? (isset($base_colors[strtolower(trim($data[7]))]) ? $base_colors[strtolower(trim($data[7]))]->id : 'empty') : null;
                $base_color_name    = (isset($data[7]) && $data[7] != null) ? strtolower(trim($data[7])) : null;
                $color          = (isset($data[8]) && $data[8] != null) ? (isset($colors[strtolower(trim($data[8]))]) ? $colors[strtolower(trim($data[8]))]->id : 'empty') : null;
                $color_name     = (isset($data[8]) && $data[8] != null) ? strtolower(trim($data[8])) : null;
                $color_value   = (isset($data[9]) && $data[9] != null) ? trim($data[9]) : 0;
                $size           = (isset($data[10]) && $data[10] != null) ? (isset($sizes[strtolower(trim($data[10]))]) ? $sizes[strtolower(trim($data[10]))]->id : 'empty') : null;
                $size_name      = (isset($data[10]) && $data[10] != null) ? strtolower(trim($data[10])) : null;
                $qty            = (isset($data[11]) && $data[11] != null) ? trim($data[11]) : null;
                $selling_price  = (isset($data[12]) && $data[12] != null) ? trim($data[12]) : null;
                $cost_price     = null; //(isset($data[13]) && $data[13] != null) ? trim($data[13]) : null;
                $is_default     = (isset($data[14]) && $data[14] != null) ? ((strtolower(trim($data[14])) == "yes") ? 10 : 0) : 0;
                $keywords       = (isset($data[15]) && $data[15] != null) ? trim($data[15]) : null;
                $short_description  = (isset($data[16]) && $data[16] != null) ? trim($data[16]) : "";
                $long_description   = (isset($data[17]) && $data[17] != null) ? trim($data[17]) : "";
                $variant = null;
                if ($color_name != null && $size_name != null) {
                    $variant = $color_name . '/' . $size_name;
                } elseif ($color_name != null && $size_name == null) {
                    $variant = $color_name;
                } elseif ($color_name == null && $size_name != null) {
                    $variant = $size_name;
                }

                if ($product_name != null || $keywords != null) {

                    // initialize array
                    $variation = [];
                    $seo = [];

                    // store brand if not exists
                    if ($brand != null && $brand == 'empty') {
                        $brand = BrandService::_excel_saving(ucwords(trim($data[4])));
                    }

                    // store category if not exists
                    if ($category != null) {
                        CategoryService::_excel_saving(ucwords(trim($data[3])));
                    }

                    // store size if not exists
                    if ($size != null && $size == 'empty') {
                        $size = SizeService::_excel_saving($size_name);
                    }

                    // store color if not exists
                    if ($base_color != null && $base_color == 'empty') {
                        $base_color = ColorGroupService::_excel_saving($base_color_name);
                    }

                    if ($color != null && $color == 'empty') {
                        $color = ColorService::_excel_saving($color_name, $color_value, $base_color);
                    }

                    $sku = ProductVariantService::_generate_sku('');
                    if ($product_name != '') {
                        $productModel = Product::where('name', '=', $product_name)->first();
                        
                        if ($productModel == null) {
                            $model                          = new Product();
                            $model->user_id                 = auth()->user()->id;
                            $model->uuid                    = Str::uuid()->toString();
                            $model->image_link              = $image_link;
                            $model->name                    = $product_name;
                            $model->brand_id                = $brand;
                            $model->keywords                = $keywords;
                            $model->short_description       = trim_description($short_description);
                            $model->long_description        = trim_description($long_description);
                            $model->video_url               = $video_url;
                            $model->is_active               = 10;
                            $model->has_variant             = $has_variant;
                            $model->show_qty                = 0;
                            $model->hit_count               = 0;
                            $model->purchase_count          = 0;
                            if ($model->save()) {
                                $product_id = $model->id;

                                $rep_original = str_replace(array('\'', '"', ',', ';', '-', '<', '>', '_', '$', '%','(',')', ' '), '-', Str::lower($product_name));
                                if(str_starts_with($rep_original, 'p/')){
                                    $alias = $rep_original;
                                }else{
                                    $alias = 'p/'.$rep_original;
                                }
                                WebAliasService::_storing('product_id', $product_id, $alias);

                                $categories = explode('|', $category);
                                ProductCategory::where('product_id', $product_id)->delete();
                                $scate = [];
                                foreach($categories as $cate) {
                                    $scate[] =  [
                                        'product_id'    => $product_id,
                                        'category_id'   => $dbcategories[trim($cate)]->id
                                    ];
                                }

                                if (isset($scate) && !empty($scate)) {
                                    ProductCategory::insert($scate);
                                }

                                $seo['meta_title']              = $model->name;
                                $seo['meta_description']        = $model->short_description;
                                $seo['meta_keywords']           = $model->keywords;
                                $seo['image']                   = null;
                                $seo['image_alt']               = $model->name;

                                self::_save_excel_seo($product_id, $seo);

                                $variation[] =  [
                                    'product_id'              => $product_id,
                                    'sku'                     => $sku,
                                    'size_id'                 => $size,
                                    'color_id'                => $color,
                                    'variant'                 => $variant,
                                    'qty'                     => $qty,
                                    'selling_price'           => $selling_price,
                                    'compare_price'           => null,
                                    'cost_price'              => $cost_price,
                                    'is_default'              => $is_default,
                                    'is_active'               => 10,
                                ];

                                if (isset($variation) && !empty($variation)) {
                                    ProductVariant::insert($variation);
                                }
                            }
                        } else {
                            $productModel->user_id                 = auth()->user()->id;
                            $productModel->uuid                    = Str::uuid()->toString();
                            $productModel->image_link              = $image_link;
                            $productModel->name                    = $product_name;
                            $productModel->brand_id                = $brand;
                            $productModel->keywords                = $keywords;
                            $productModel->short_description       = trim_description($short_description);
                            $productModel->long_description        = trim_description($long_description);
                            $productModel->video_url               = $video_url;
                            $productModel->is_active               = 10;
                            $productModel->has_variant             = $has_variant;
                            $productModel->show_qty                = 0;
                            $productModel->hit_count               = 0;
                            $productModel->purchase_count          = 0;
                            if ($productModel->update()) {
                                $product_id = $productModel->id;
                                $rep_original = str_replace(array('\'', '"', ',', ';', '-', '<', '>', '_', '$', '%','(',')', ' '), '-', Str::lower($product_name));
                                if(str_starts_with($rep_original, 'p/')){
                                    $alias = $rep_original;
                                }else{
                                    $alias = 'p/'.$rep_original;
                                }
                                WebAliasService::_updating('product_id', $product_id, $alias);

                                $categories = explode('|', $category);
                                ProductCategory::where('product_id', $product_id)->delete();
                                $scate = [];
                                foreach($categories as $cate) {
                                    $scate[] =  [
                                        'product_id'    => $product_id,
                                        'category_id'   => $dbcategories[trim($cate)]->id
                                    ];
                                }

                                if (isset($scate) && !empty($scate)) {
                                    ProductCategory::insert($scate);
                                }

                                $seo['meta_title']              = $productModel->name;
                                $seo['meta_description']        = $productModel->short_description;
                                $seo['meta_keywords']           = $productModel->keywords;
                                $seo['image']                   = null;
                                $seo['image_alt']               = $productModel->name;

                                self::_save_excel_seo($product_id, $seo);
                                $product_variant = ProductVariant::where('product_id', $product_id)->delete();
                                $variation[] =  [
                                    'product_id'              => $product_id,
                                    'sku'                     => $sku,
                                    'size_id'                 => $size,
                                    'color_id'                => $color,
                                    'variant'                 => $variant,
                                    'qty'                     => $qty,
                                    'selling_price'           => $selling_price,
                                    'compare_price'           => null,
                                    'cost_price'              => $cost_price,
                                    'is_default'              => $is_default,
                                    'is_active'               => 10,
                                ];

                                if (isset($variation) && !empty($variation)) {
                                    ProductVariant::insert($variation);
                                }
                            }
                        }
                    }
                }
            }
        }
        return true;
    }

    public static function _save_excel_seo($id, $product_seo)
    {
        $seo = ProductSeo::firstOrNew(['product_id' => $id]);
        $seo->product_id        = $id;
        $seo->meta_title        = $product_seo['meta_title'];
        $seo->meta_keywords     = $product_seo['meta_keywords'];
        $seo->meta_description  = $product_seo['meta_description'];
        $seo->image             = $product_seo['image'];
        $seo->image_alt         = $product_seo['image_alt'];
        $seo->save();
    }

    public static function _autosearching($req)
    {
        $products = Product::select('id', 'name')->where(['is_active' => 10, 'is_combo_product' => 0])->where("name","LIKE","%{$req->get('q')}%")->get()->toArray();
        return $products;
    }

    public static function _searching($req)
    {
        if ($req->has('categories') || $req->has('brands') || $req->product != null) {
            $products = Product::with('thumbnail', 'product_categories.category', 'brand', 'offer');
            if ($req->has('categories')) {
                $product_categories = ProductCategory::distinct('product_id')->whereIN('category_id', $req->categories)->get()->toArray();
                $product_ids = array_column($product_categories, 'product_id');
                $products->whereIN('id', $product_ids);
            }
            if ($req->has('brands')) {
                $products->whereIn('brand_id', $req->brands);
            }
            if ($req->product != null) {
                $products->where('name', 'like', $req->product . '%');
            }
            return $products->where('is_active', 10)->get();
        }
        return false;
    }
}
