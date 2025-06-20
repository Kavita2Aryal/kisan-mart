<?php

namespace App\Services\Ecommerce\ComboProduct;

use App\Models\Cms\WebAlias;
use App\Models\Ecommerce\Brand;
use App\Models\Ecommerce\Category;
use App\Models\Ecommerce\Color;
use App\Models\Ecommerce\ColorGroup;
use App\Services\Cms\WebAliasService;
use App\Services\Ecommerce\ComboProduct\ComboProductVariantService;
use App\Models\Ecommerce\ComboProduct\ComboProduct;
use App\Models\Ecommerce\ComboProduct\ComboProductImage;
use App\Models\Ecommerce\ComboProduct\ComboProductSeo;
use App\Models\Ecommerce\ComboProduct\ComboProductSizeChartImage;
use App\Models\Ecommerce\ComboProduct\ComboProductVariant;
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

class ComboProductService
{
    public static function _find($uuid)
    {
        return ComboProduct::where('uuid', $uuid)->firstOrFail();
    }

    public static function _get()
    {
        return ComboProduct::orderBy('created_at', 'DESC')->get();
    }

    public static function _paging($req)
    {
        $per_page = search_filter_int($req->per_page ?? null, 10);
        $search = search_filter_string($req->search ?? null);

        $data = ComboProduct::with(['category', 'brand', 'alias', 'user'])->orderBy('created_at', 'DESC');
        if ($search) { 
            $data->where('name', 'LIKE', '%'.$search.'%');
        }
        return $data->paginate($per_page);
    }

    public static function _storing($req)
    {
        $model = new ComboProduct();
        $model->name                    = $req->name;
        //$model->slug                    = $req->alias; //only for feature testing
        $model->category_id             = $req->category;
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

        if ($model->save()) {
            if(str_starts_with($req->alias, 'p/')){
                $alias = $req->alias;
            }else{
                $alias = 'p/'.$req->alias;
            }
            WebAliasService::_storing('product_id', $model->id, $alias);
            self::_save_seo($model->id, $req);
            self::_save_thumbnail($model->id, $req->thumbnail);
            if ($req->has('gallery')) {
                self::_save_images($model->id, $req->gallery);
            }
            ComboProductVariantService::_saving($model->id, $req, $model->has_variant);
            if($req->collections != null)
            {
                CollectionService::_storing_product($req->collections, $model->id);
            }
            return true;
        }
        return false;
    }

    public static function _updating($req, $uuid)
    {
        $model = self::_find($uuid);
        if (!$model) return false;

        $model->name                    = $req->name;
        $model->category_id             = $req->category;
        $model->brand_id                = $req->brand;
        $model->keywords                = $req->seo['meta_keywords'];
        $model->short_description       = trim_description($req->short_description);
        $model->long_description        = trim_description($req->long_description);
        $model->is_active               = $req->has('is_active') ? 10 : 0;
        $model->has_variant             = $req->has('has_variant') ? 10 : 0;
        $model->show_qty                = $req->has('show_qty') ? 10 : 0;
        $model->hit_count               = 0;
        $model->purchase_count          = 0;

        if ($model->update()) {
            if(str_starts_with($req->alias, 'p/')){
                $alias = $req->alias;
            }else{
                $alias = 'p/'.$req->alias;
            }
            WebAliasService::_updating('product_id', $model->id, $alias);
            self::_save_seo($model->id, $req);
            self::_save_thumbnail($model->id, $req->thumbnail);
            if ($req->has('gallery')) {
                self::_save_images($model->id, $req->gallery);
            }
            ComboProductVariantService::_updating($model->id, $req, $model->has_variant);
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

    public static function _save_seo($id, $req)
    {
        $seo = ComboProductSeo::firstOrNew(['product_id' => $id]);
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
        ComboProductImage::where(['product_id' => $id, 'is_thumb' => 0, 'color_id' => null])->delete();
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
            $thumb = ComboProductImage::firstOrNew(['product_id' => $id, 'is_thumb' => 10, 'color_id' => null]);
            if ($thumb->image != $data) {
                ImageUploadService::_remove($thumb->image, 'product');
            }
            $thumb->image = $data;
            $thumb->save();
        }
    }

    public static function _get_variant_details($product)
    {
        $color_image_arr = [];
        $selected_colors = [];
        $selected_sizes = [];
        $mockfiles = [];
        $image_mock = [];
        if ($product->has_variant == 10 && isset($product->variants) && $product->variants != '') {
            foreach ($product->variants as $key => $variation) {
                if ($variation->images() != null && count($variation->images()) > 0) {
                    $color_image_arr[$key]['color'] = $variation->color_id;
                    $mockfiles[$variation->color_id] = self::_color_images($variation->images(), $image_mock);
                    foreach ($variation->images() as $image) {
                        if ($variation->color_id == $image->color_id) {
                            $color_image_arr[$key]['images'][] = $image->image;
                        }
                    }
                }
                if ($variation->color_id != null) {
                    $c_arr = [
                        'id' => $variation->color_id,
                        'name' => $variation->variant_color->name,
                    ];
                    if (!in_array($c_arr, $selected_colors)) {
                        $selected_colors[] = $c_arr;
                    }
                }
                if ($variation->size_id != null) {
                    $s_arr = [
                        'id' => $variation->size_id,
                        'name' => $variation->variant_size->value,
                    ];
                    if (!in_array($s_arr, $selected_sizes)) {
                        $selected_sizes[] = $s_arr;
                    }
                }
            }
        }
        return [
            'color_image_arr' => $color_image_arr,
            'selected_colors' => $selected_colors,
            'selected_sizes' => $selected_sizes,
            'mockfiles' => $mockfiles,
            'image_mock' => $image_mock,
        ];
    }

    public static function _color_images($images, $image_mock)
    {
        foreach ($images as $key => $image) {
            if (Storage::exists('public/ecommerce/' . $image->image)) {
                $image_mock[] = [
                    'url' => Storage::url('public/ecommerce/' . $image->image),
                    'name' => $image->image,
                    'size' => Storage::size('public/ecommerce/' . $image->image)
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
        foreach ($data as $row) {
            if($row->has_variant == 10 && $row->other_variants != null)
            {
                $a = 'S';
                $count = count($row->other_variants);
                $title_arr = ['SKU', 'Color', 'Size', 'Qty', 'Selling Price', 'Cost Price'];
                for($c = 1; $c <= $count; $c++){
                    foreach($title_arr as $title){
                        $a++;
                        $head = $a . 1;
                        $array_column_heading_names[$head] = $title;
                    }
                }
            }
        }
        $array = [];
        if ($data) {
            $i = 1; // always start this from 1
            foreach ($data as $key => $row) {
                $i++;
                $array[$key]['A' . $i] = $row->name;
                $array[$key]['B' . $i] = $row->category->name;
                $array[$key]['C' . $i] = $row->brand->name;
                $array[$key]['D' . $i] = $row->video_url ?? '-';
                $array[$key]['E' . $i] = $row->keywords ?? '-';
                $array[$key]['F' . $i] = $row->short_description ?? '-';
                $array[$key]['G' . $i] = $row->long_description ?? '-'; 
                $array[$key]['H' . $i] = $row->hit_count;
                $array[$key]['I' . $i] = date('Y-m-d H:i:s', strtotime($row->created_at));
                $array[$key]['J' . $i] = $row->has_variant == 10 ? 'yes' : 'no';
                $array[$key]['K' . $i] = $row->default_variant->sku;
                $array[$key]['L' . $i] = $row->default_variant->variant_color->name ?? '-';
                $array[$key]['M' . $i] = $row->default_variant->variant_size->value ?? '-';
                $array[$key]['N' . $i] = $row->default_variant->qty;
                $array[$key]['O' . $i] = $row->default_variant->selling_price ?? '-';
                $array[$key]['P' . $i] = $row->default_variant->cost_price ?? '-';
                if($row->has_variant == 10 && $row->other_variants != null)
                {
                    $x = 'S';
                    $count = count($row->other_variants);
                    $variable_arr = ['sku', 'color', 'size', 'qty', 'selling_price', 'cost_price'];
                    foreach($row->other_variants as $item){
                        foreach($variable_arr as $var){
                            $x++;
                            if($var == 'color')
                            {
                                $array[0][$x . $i] = $item->variant_color->name ?? '-';
                            }elseif($var == 'size')
                            {
                                $array[0][$x . $i] = $item->variant_size->value ?? '-';
                            }else{
                                $array[0][$x . $i] = $item[$var] ?? '-';
                            }
                        }
                    }
                }
                
            }
        }
        // dd($array_column_heading_names, $array);
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
        $categories     = Category::select('id', DB::raw('LOWER(name) as dname'))->get()->keyBy('dname');
        $brands         = Brand::select('id', DB::raw('LOWER(name) as dname'))->get()->keyBy('dname');
        $sizes          = Size::select('id', DB::raw('LOWER(value) as dname'))->get()->keyBy('dname');
        $base_colors    = ColorGroup::select('id', DB::raw('LOWER(name) as dname'))->get()->keyBy('dname');
        $colors         = Color::select('id', DB::raw('LOWER(name) as dname'))->get()->keyBy('dname');
        foreach ($sheetData as $key => $row) {
            $old_name = '';
            $i = 0;
            $parent_category          = isset($categories[Str::lower(trim($key))]) ? $categories[Str::lower(trim($key))]->id : 0;
            foreach ($row as $data) {
                $i++;
                $product_name   = (isset($data[0]) && $data[0] != null) ? trim($data[0]) : null;
                $category       = (isset($data[1]) && $data[1] != null) ? (isset($categories[strtolower(trim($data[1]))]) ? $categories[strtolower(trim($data[1]))]->id : 0) : null;
                $brand       = (isset($data[2]) && $data[2] != null) ? (isset($brands[strtolower(trim($data[2]))]) ? $brands[strtolower(trim($data[2]))]->id : 0) : null;
                $video_url = (isset($data[3]) && $data[3] != null) ? trim($data[3]) : null;
                $has_variant = (isset($data[4]) && $data[4] != null) ? ((strtolower(trim($data[4])) == "yes") ? 10 : 0) : 0;
                $show_qty = (isset($data[5]) && $data[5] != null) ? ((strtolower(trim($data[5])) == "yes") ? 10 : 0) : 0;
                $base_color       = (isset($data[6]) && $data[6] != null) ? (isset($base_colors[strtolower(trim($data[6]))]) ? $base_colors[strtolower(trim($data[6]))]->id : 0) : null;
                $base_color_name = (isset($data[6]) && $data[6] != null) ? trim($data[6]) : null;
                $base_color_value = (isset($data[7]) && $data[7] != null) ? trim($data[7]) : 0;
                $color       = (isset($data[8]) && $data[8] != null) ? (isset($colors[strtolower(trim($data[8]))]) ? $colors[strtolower(trim($data[8]))]->id : 0) : null;
                $color_name = (isset($data[8]) && $data[8] != null) ? trim($data[8]) : null;
                $size       = (isset($data[9]) && $data[9] != null) ? (isset($sizes[strtolower(trim($data[9]))]) ? $sizes[strtolower(trim($data[9]))]->id : 0) : null;
                $size_name = (isset($data[9]) && $data[9] != null) ? trim($data[9]) : null;
                $qty       = (isset($data[10]) && $data[10] != null) ? trim($data[10]) : null;
                $selling_price = (isset($data[11]) && $data[11] != null) ? trim($data[11]) : null;
                $cost_price = (isset($data[12]) && $data[12] != null) ? trim($data[12]) : null;
                $is_default = (isset($data[13]) && $data[13] != null) ? ((strtolower(trim($data[13])) == "yes") ? 10 : 0) : 0;
                $keywords       = (isset($data[14]) && $data[14] != null) ? trim($data[14]) : null;
                $short_description   = (isset($data[15]) && $data[15] != null) ? trim($data[15]) : "";
                $long_description   = (isset($data[16]) && $data[16] != null) ? trim($data[16]) : "";
                $variant = null;
                if ($color_name != null && $size_name != null) {
                    $variant = ucwords($color_name) . '/' . ucwords($size_name);
                } elseif ($color_name != null && $size_name == null) {
                    $variant = ucwords($color_name);
                } elseif ($color_name == null && $size_name != null) {
                    $variant = ucwords($size_name);
                }

                if ($product_name != null || $keywords != null) {

                    // initialize array
                    $variation = [];
                    $seo = [];

                    // store brand if not exists
                    if ($brand != null && $brand == 0) {
                        $brand = BrandService::_excel_saving(ucwords($data[3]));
                    }
                    // store category if not exists
                    if ($parent_category == 0) {
                        $parent_category = CategoryService::_excel_saving(ucwords($key), 0);
                    }
                    // store category if not exists
                    if ($category != null && $category == 0) {
                        $category = CategoryService::_excel_saving(ucwords($data[2]), $parent_category);
                    }

                    // store size if not exists
                    if ($size != null && $size == 0) {
                        $size = SizeService::_excel_saving(strtoupper($data[10]));
                    }

                    // store color if not exists
                    if ($base_color != null && $base_color == 0) {
                        $base_color = ColorGroupService::_excel_saving(ucwords($data[7]), $base_color_value);
                    }

                    if ($color != null && $color == 0) {
                        $color = ColorService::_excel_saving(ucwords($data[9]));
                    }

                    $sku = ComboProductVariantService::_generate_sku('');
                    if (trim($product_name) != '') {
                        $productModel = ComboProduct::where('name', '=', $product_name)
                            ->first();

                        if ($productModel == null) {
                            $model                          = new ComboProduct();
                            $model->user_id                 = auth()->user()->id;
                            $model->uuid                    = Str::uuid()->toString();
                            $model->name                    = $product_name;
                            $model->category_id             = $category;
                            $model->brand_id                = $brand;
                            $model->keywords                = $keywords;
                            $model->short_description       = trim_description($short_description);
                            $model->long_description        = trim_description($long_description);
                            $model->video_url               = $video_url;
                            $model->is_active               = 10;
                            $model->has_variant             = $has_variant;
                            $model->show_qty                = $show_qty;
                            $model->hit_count               = 0;
                            $model->purchase_count          = 0;
                            if ($model->save()) {
                                $rep_original = str_replace(array('\'', '"', ',', ';', '-', '<', '>', '_', '$', '%', ' '), '-', Str::lower($product_name));
                                if(str_starts_with($rep_original, 'p/')){
                                    $alias = $rep_original;
                                }else{
                                    $alias = 'p/'.$rep_original;
                                }
                                $webaliasModel = WebAlias::where('alias', $alias)->first();
                                $aliasName = ($webaliasModel == null) ? $alias : $alias . '-' . $i;
                                WebAliasService::_storing('product_id', $model->id, $aliasName);

                                $seo['meta_title']              = $model->name;
                                $seo['meta_description']        = $model->short_description;
                                $seo['meta_keywords']           = $model->keywords;
                                $seo['image']                   = null;
                                $seo['image_alt']               = $model->name;

                                self::_save_excel_seo($model->id, $seo);

                                $variation[] =  [
                                    'product_id'              => $model->id,
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
                                    ComboProductVariant::insert($variation);
                                }
                            }
                        } else {
                            $productModel->user_id                 = auth()->user()->id;
                            $productModel->uuid                    = Str::uuid()->toString();
                            $productModel->name                    = $product_name;
                            $productModel->category_id             = $category;
                            $productModel->brand_id                = $brand;
                            $productModel->keywords                = $keywords;
                            $productModel->short_description       = trim_description($short_description);
                            $productModel->long_description        = trim_description($long_description);
                            $productModel->video_url               = $video_url;
                            $productModel->is_active               = 10;
                            $productModel->has_variant             = $has_variant;
                            $productModel->show_qty                = $show_qty;
                            $productModel->hit_count               = 0;
                            $productModel->purchase_count          = 0;
                            if ($productModel->update()) {

                                $rep_original = str_replace(array('\'', '"', ',', ';', '-', '<', '>', '_', '$', '%', ' '), '-', Str::lower($product_name));
                                if(str_starts_with($rep_original, 'p/')){
                                    $alias = $rep_original;
                                }else{
                                    $alias = 'p/'.$rep_original;
                                }
                                $webaliasModel = WebAlias::where('alias', $alias)->first();
                                $aliasName = ($webaliasModel == null) ? $alias : $alias . '-' . $i;
                                WebAliasService::_updating('product_id', $productModel->id, $aliasName);

                                $seo['meta_title']              = $productModel->name;
                                $seo['meta_description']        = $productModel->short_description;
                                $seo['meta_keywords']           = $productModel->keywords;
                                $seo['image']                   = null;
                                $seo['image_alt']               = $productModel->name;

                                self::_save_excel_seo($productModel->id, $seo);
                                $product_variant = ComboProductVariant::where('sku', $sku)->first();
                                if ($product_variant) {
                                    $product_variant->delete();
                                }
                                $variation[] =  [
                                    'product_id'              => $productModel->id,
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
                                    ComboProductVariant::insert($variation);
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
        $seo = ComboProductSeo::firstOrNew(['product_id' => $id]);
        $seo->product_id        = $id;
        $seo->meta_title        = $product_seo['meta_title'];
        $seo->meta_keywords     = $product_seo['meta_keywords'];
        $seo->meta_description  = $product_seo['meta_description'];
        $seo->image             = $product_seo['image'];
        $seo->image_alt         = $product_seo['image_alt'];
        $seo->save();
    }

    public static function _searching($req)
    {
        if ($req->has('categories') || $req->has('brands') || $req->product != null || $req->has('ready-to-wear')) {
            $products = ComboProduct::with('thumbnail', 'category', 'brand', 'offer');
            if ($req->ready_to_wear != null && $req->ready_to_wear == 10) {
                $products->where('type', 1);
            }
            if ($req->has('categories')) {
                $products->whereIn('category_id', $req->categories);
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
