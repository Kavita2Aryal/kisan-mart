<?php

namespace App\Services\Ecommerce\Product;

use App\Models\Ecommerce\Product\ProductImage;
use App\Models\Ecommerce\Product\ProductVariant;

class ProductVariantService
{
    public static function _get_last_sku()
    {
        return ProductVariant::select('sku')->orderBy('sku', 'DESC')->first();
    }

    public static function _get_details($product_id)
    {
        $model = ProductVariant::where('product_id', $product_id)->get();
        return $model ?? false;
    }

    public static function _generate_sku($variant)
    {
        $sku_type = 'S-';
        $get_variant = self::_get_last_sku();
        $value = 0;
        if ($get_variant != null) {
            $current_sku = $get_variant->sku;
            $split = explode('S-', $current_sku);
            $value = (int) $split[1];
        }
        if ($variant == '') {
            $value++;
            $sku_number = str_pad($value, 6, '0', STR_PAD_LEFT);
            $sku = $sku_type . $sku_number;
            return $sku;
        } else {
            $variant_sku = [];
            foreach ($variant as $key => $row) {
                if ($row['sku'] == null) {
                    $value++;
                    $sku_number = str_pad($value, 6, '0', STR_PAD_LEFT);
                    $sku = $sku_type . $sku_number;
                    $variant_sku[$key] = $sku;
                }
            }
            return $variant_sku;
        }
    }

    public static function _saving($id, $req, $has_variant)
    {
        if (($has_variant == 10) && $req->variants != null) {
            $sku = self::_generate_sku($req->variants);
            foreach ($req->variants as $key => $row) {
                $batch[] = [
                    'product_id'              => $id,
                    'sku'                     => $sku[$key],
                    'size_id'                 => $row['size'],
                    'color_id'                => $row['color'],
                    'variant'                 => $row['variant'],
                    'qty'                     => $row['qty'],
                    'selling_price'           => $row['selling_price'],
                    'compare_price'           => $row['compare_price'],
                    'cost_price'              => $row['cost_price'],
                    'is_default'              => isset($row['is_default']) ? 10 : 0,
                    'is_active'               => isset($row['is_active']) ? 10 : 0,
                ];
            }
            if (isset($batch) && !empty($batch)) {
                ProductVariant::insert($batch);
                if ($req->colors != null) {
                    self::_save_variant_images($id, $req->colors);
                }
                return true;
            }
        } else {
            $model = new ProductVariant();
            $model->product_id              = $id;
            $model->sku                     = self::_generate_sku('');
            $model->size_id                 = null;
            $model->color_id                = null;
            $model->variant                 = null;
            $model->qty                     = $req->qty;
            $model->selling_price           = $req->selling_price;
            $model->compare_price           = $req->compare_price;
            $model->cost_price              = $req->cost_price;
            $model->is_default              = 10;
            $model->is_active               = 10;
            if ($model->save()) {
                return true;
            }
        }
        return false;
    }

    public static function _updating($id, $req, $has_variant)
    {
        if (($has_variant == 10) && $req->variants != null) {
            $sku = self::_generate_sku($req->variants);
            foreach ($req->variants as $key => $row) {
                $batch[] = [
                    'product_id'              => $id,
                    'sku'                     => $row['sku'] ?? $sku[$key],
                    'size_id'                 => $row['size'],
                    'color_id'                => $row['color'],
                    'variant'                 => $row['variant'],
                    'qty'                     => $row['qty'],
                    'selling_price'           => $row['selling_price'],
                    'compare_price'           => $row['compare_price'],
                    'cost_price'              => $row['cost_price'],
                    'is_default'              => isset($row['is_default']) ? 10 : 0,
                    'is_active'               => isset($row['is_active']) ? 10 : 0,
                ];
            }
            if (isset($batch) && !empty($batch)) {
                ProductVariant::where('product_id', $id)->delete();
                ProductVariant::insert($batch);
                if ($req->colors != null) {
                    self::_save_variant_images($id, $req->colors);
                }
                return true;
            }
        } else {
            ProductVariant::where('product_id', $id)->delete();
            $model = new ProductVariant();
            $model->product_id              = $id;
            $model->sku                     = $req->sku;
            $model->size_id                 = null;
            $model->color_id                = null;
            $model->variant                 = null;
            $model->qty                     = $req->qty;
            $model->selling_price           = $req->selling_price;
            $model->compare_price           = $req->compare_price;
            $model->cost_price              = $req->cost_price;
            $model->is_default              = 10;
            $model->is_active               = 10;
            if ($model->save()) {
                return true;
            }
        }
        return false;
    }

    public static function _save_variant_images($id, $colors)
    {
        ProductImage::where('product_id', $id)->whereNotNull('color_id')->delete();
        foreach ($colors as $color) {
            if (isset($color['images']) && $color['images'] != null) {
                foreach ($color['images'] as $image) {
                    $batch[] = [
                        'product_id'    => $id,
                        'color_id'      => $color['color'],
                        'image'         => $image,
                        'is_thumb'      => 0
                    ];
                }
            }
        }
        if (isset($batch) && !empty($batch)) {
            ProductImage::insert($batch);
            return true;
        }
        return false;
    }

    public static function _quick_update($req)
    {
        foreach ($req->variation as $row) {
            $model = ProductVariant::where('product_id', $req->product_id)->where('id', $row['id'])->first();
            if ($model) {
                $model->qty             = $row['qty'];
                $model->selling_price   = $row['selling_price'];
                $model->compare_price   = null;
                $model->cost_price      = $row['cost_price'];
                $model->save();
            }
        }
        return true;
    }
}
