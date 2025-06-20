@extends('layouts.app')

@section('title', 'Update Product')

@section('content')
@php $currency = 'NPR'; @endphp

<div class="container-fluid">
    <form class="m-t-20" class="form-product" method="POST" action="{{ route('product.update', [$product->uuid]) }}" data-hyperlink-search="{{ route('web.alias.hyperlink.search', [$product->uuid]) }}">
        @csrf
        @method('PUT')
        <!-- Product Main Form -->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">
                            Update Product
                            <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-r-5 pull-right" type="submit">
                                UPDATE <span class="visible-x-inline m-l-5">PRODUCT</span>
                            </button>
                            <a href="{{ route('product.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group form-group-default required @error('name') has-error @enderror">
                            <label>Product Name</label>
                            <input name="name" type="text" class="form-control @error('name') error @enderror alias-source product-name" required autocomplete="off" value="{{ $product->name ?? old('name') }}">

                            @error('name')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group form-group-default required input-group alias-edit @error('alias') has-error @enderror">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="pg-icon m-r-5">globe</i>
                                    {{ $url.'p/' }}
                                </span>
                            </div>
                            @php 
                                $alias = $product->alias->alias;
                                $split = explode('p/', $alias);
                            @endphp
                            <div class="form-input-group">
                                <input type="text" class="form-control alias-value alias-check p-b-5 @error('alias') error @enderror" name="alias" placeholder="Web Alias" required autocomplete="off" value="{{ $split[1] ?? old('alias') }}">
                                <input type="hidden" class="alias-index" name="alias_id" value="{{ $product->alias->id }}">
                            </div>
                        </div>
                        <div class="form-group form-group-default p-b-10 @error('short_description') has-error @enderror">
                            <label>Short Description</label>
                            <textarea name="short_description" class="form-control @error('short_description') error @enderror" style="height:50px;">{!! $product->short_description ?? old('short_description') !!}</textarea>
                        </div>
                        @php $indexing = indexing(); @endphp
                        <div class="form-group editor-description @error('long_description') has-error @enderror" data-index="{{ $indexing }}">
                            <label>Long Description</label>
                            <textarea class="editor-container editor-container-{{ $indexing }} @error('long_description') error @enderror" name="long_description">{{ $product->long_description ?? old('long_description') }}</textarea>
                            @error('long_description')
                            <label class="error">{{ $errors->first('long_description') }}</label>
                            @enderror
                        </div>
                        <div class="form-group form-group-default @error('video_url') has-error @enderror">
                            <label>Video Url</label>
                            <input name="video_url" type="url" class="form-control @error('video_url') error @enderror product-name" placeholder="https://" autocomplete="off" value="{{ $product->video_url ?? old('video_url') }}">

                            @error('video_url')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-check info m-t-0 m-b-0">
                            <input type="checkbox" name="is_active" value="10" id="checkbox-active" @if($product->is_active == 10) checked @endif>
                            <label for="checkbox-active">Publish ?</label>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <!-- Product Main Form -->

        <!-- Product Classifications & Seo -->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Product Classifications</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                                <div class="form-group form-group-default form-group-default-select2 required @error('categories') has-error @enderror">
                                    <label>Category</label>
                                    <select class="full-width @error('categories') error @enderror" name="categories[]" data-placeholder="Select a Category" data-init-plugin="select2" tabindex="-1" aria-hidden="true" multiple required>
                                        <option value="" data-prefix="">Select a Category</option>
                                        @if ($categories != null)
                                            @foreach($categories as $row)
                                                @if(count($row->child) > 0)
                                                <optgroup label="{{ $row->name }}">
                                                    @foreach($row->child as $child)
                                                        <option value="{{ $child->id }}" @if(in_array($child->id, $product_categories)) selected @endif>{{ $child->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                                @else
                                                    <option value="{{ $row->id }}" @if(in_array($row->id, $product_categories)) selected @endif>{{ $row->name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>

                                    @error('categories')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                                <div class="form-group form-group-default form-group-default-select2 required @error('brand') has-error @enderror">
                                    <label>Brand</label>
                                    <select class="full-width @error('brand') error @enderror" name="brand" data-placeholder="Select a Brand" data-init-plugin="select2" tabindex="-1" aria-hidden="true" required>
                                        <option value="" data-prefix="">Select a Brand</option>
                                        @if ($brands != null)
                                        @foreach($brands as $row)
                                        <option value="{{ $row->id }}" @if($row->id == $product->brand_id) selected @endif>{{ $row->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>

                                    @error('brand')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                                <div class="form-group form-group-default form-group-default-select2 @error('collection') has-error @enderror">
                                    <label>Collections</label>
                                    <select class="full-width @error('collection') error @enderror" name="collections[]" data-placeholder="Select Collections" data-init-plugin="select2" multiple>
                                        <option value="" data-prefix="">Select Collections</option>
                                        @if ($collection_types != null && $collections != null)
                                            @foreach($collections as $key => $row)
                                                <optgroup label="{{ $collection_types[$key] }}">
                                                    @foreach($row as $child)
                                                        <option value="{{ $child->id }}" @if($child->id == old('collection')) selected @endif>{{ $child->name }}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        @endif
                                    </select>

                                    @error('collection')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">SEO Details</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group required form-group-default @error('seo.meta_title') has-error @enderror">
                            <label>Meta Title</label>
                            <input type="text" class="form-control @error('seo.meta_title') error @enderror" required autocomplete="off" name="seo[meta_title]" value="{{ $product->seo->meta_title ?? old('seo.meta_title') }}" />
                        </div>
                        @error('seo.meta_title')
                        <label class="error">{{ $message }}</label>
                        @enderror
                        <div class="form-group required form-group-default @error('seo.meta_description') has-error @enderror">
                            <label>Meta Description</label>
                            <textarea class="form-control @error('seo.meta_description') error @enderror" required style="height:80px;" name="seo[meta_description]">{!! $product->seo->meta_description ?? old('seo.meta_description') !!}</textarea>
                        </div>
                        @error('seo.meta_description')
                        <label class="error">{{ $message }}</label>
                        @enderror
                        <div class="form-group required form-group-default form-group-tagsinput seo-keywords @error('seo.meta_keywords') has-error @enderror" style="height:80px;">
                            <label>Type Meta Keywords & press enter</label>
                            <input type="text" class="form-control @error('seo.meta_keywords') error @enderror" data-role="tagsinput" name="seo[meta_keywords]" autocomplete="off" value="{{ $product->seo->meta_keywords ?? old('seo.meta_keywords') }}" />
                        </div>
                        @error('seo.meta_keywords')
                        <label class="error">{{ $message }}</label>
                        @enderror
                        <div class="form-group required form-group-default m-b-0 @error('seo.image_alt') has-error @enderror">
                            <label>Meta Image Alt</label>
                            <input type="text" class="form-control @error('seo.image_alt') error @enderror" required autocomplete="off" name="seo[image_alt]" value="{{ $product->seo->image_alt ?? old('seo.image_alt') }}" />
                        </div>
                        @error('seo.image_alt')
                        <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Classifications & Seo -->

        <!-- Product Type -->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">
                            Product Variants, Prices, Quantity & Images
                            <div class="row m-t-15">
                                <div class="col-sm-12 col-xlg-12 col-lg-12 col-md-12">
                                    <div class="form-check form-check-inline switch switch-lg m-b-25">
                                        <input type="checkbox" name="show_qty" class="show_qty" id="show_qty" value="{{ ($product->show_qty == 10) ? 10 : 0 }}" @if($product->show_qty == 10) checked @endif>
                                        <label for="show_qty"></label>
                                    </div>
                                    <strong style="margin-left: -15px;">Show Product Quantity on the website ?</strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xlg-12 col-lg-12 col-md-12 @if($product->has_variant == 0) display-none @endif">
                                    <div class="form-check danger form-check-inline switch switch-lg m-b-15 display-none">
                                        <input type="checkbox" name="has_variant" class="has-variant" id="has-variant" value="{{ ($product->has_variant == 10) ? 10 : 0 }}" @if($product->has_variant == 10) checked @endif>
                                        <label for="has-variant"></label>
                                    </div>
                                    <strong style="margin-left: -15px;">This product has multiple options, like different sizes and colors</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body is-variant-container @if($product->has_variant == 0) display-none @endif">
                        <div class="color-container">
                            <div class="row color-content content-item">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                                    <div class="form-group form-group-default form-group-default-select2">
                                        <label for="">Color</label>
                                        <!-- <select class="full-width is-variant-option color-option-value" data-placeholder="Select Colors" multiple="multiple">
                                            @if ($colors != null)
                                            @foreach($colors as $row)
                                            @if(($selected_colors != [] && (array_search($row['id'], array_column($selected_colors, 'id')) !== false)))
                                            <option value="{{ $row['id'] }}" selected>{{ $row['name'] }}</option>
                                            @endif
                                            @endforeach
                                            @endif 
                                        </select> -->
                                        <select class="full-width is-variant-option color-option-value" data-placeholder="Select Colors" data-init-plugin="select2" multiple="multiple">
                                            <option value="" data-prefix="">Select Colors</option>
                                            @if ($colors != null)
                                            @foreach($colors as $row)
                                            <option value="{{ $row['id'] }}" {{ ($selected_colors != [] && (array_search($row['id'], array_column($selected_colors, 'id')) !== false)) ? 'selected' : '' }}>{{ $row['name'] }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="size-container">
                            <div class="row size-content content-item">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                                    <div class="form-group form-group-default form-group-default-select2">
                                        <label for="">Sizes</label>
                                        <!-- <select class="full-width is-variant-option size-option-value" data-placeholder="Select Sizes" multiple="multiple">
                                            @if ($sizes != null)
                                            @foreach($sizes as $row)
                                            @if(($selected_sizes != [] && (array_search($row['id'], array_column($selected_sizes, 'id')) !== false)))
                                            <option value="{{ $row['id'] }}" selected>{{ $row['name'] }}</option>
                                            @endif
                                            @endforeach
                                            @endif
                                        </select> -->
                                        <select class="full-width is-variant-option size-option-value" data-placeholder="Select Sizes" data-init-plugin="select2" multiple="multiple">
                                            <option value="" data-prefix="">Select Sizes</option>
                                            @if ($sizes != null)
                                            @foreach($sizes as $row)
                                            <option value="{{ $row['id'] }}" {{ ($selected_sizes != [] && (array_search($row['id'], array_column($selected_sizes, 'id')) !== false)) ? 'selected' : '' }}>{{ $row['name'] }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="variant-container">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                                    <div class="table-responsive m-b-5">
                                        <div class="no-footer">
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th style="width:200px">Variant </th>
                                                        <th style="width:200px">SKU <strong class="text-danger">*</strong></th>
                                                        <th style="width:200px">Available QTY <strong class="text-danger">*</strong></th>
                                                        <th style="width:200px">Selling Price <strong class="text-danger">*</strong></th>
                                                        <th style="width:200px; display:none;">Compare Price</th>
                                                        <th style="width:200px">Cost Price</th>
                                                        <th style="width:200px">Active ?</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="variant-item-container is-variant-item">
                                                    <tr class="variant-item-not-selected">
                                                        <td colspan="6">Please select colors and sizes for product variant options.</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-20 color-item-container is-variant-item"></div>

                    </div>
                    <div class="card-body not-variant-container parent-container p-t-0 @if($product->has_variant == 10) display-none @endif">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                                <div class="table-responsive m-b-5">
                                    <div class="no-footer">
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                    <th style="width:150px">SKU <strong class="text-danger">*</strong></th>
                                                    <th style="width:100px">Available QTY <strong class="text-danger">*</strong></th>
                                                    <th style="width:150px">Selling Price <strong class="text-danger">*</strong></th>
                                                    <th style="width:150px; display:none;">Compare Price</th>
                                                    <th style="width:150px">Cost Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $required = ($product->type == 1 && $product->has_variant != 10) ? 'required' : ''; @endphp
                                                <tr>
                                                    <td class="v-align-middle p-l-5 p-r-5">
                                                        <input name="sku" readonly placeholder="SKU" type="text" class="form-control @error('sku') error @enderror product-sku" autocomplete="off" value="{{ $product->default_variant->sku ?? old('sku') }}" style="color:black;">
                                                        @error('sku')
                                                        <label class="error">{{ $message }}</label>
                                                        @enderror
                                                    </td>
                                                    <td class="v-align-middle p-l-5 p-r-5">
                                                        <input name="qty" placeholder="QTY" type="number" min="0" max="9999999999" class="form-control @error('qty') error @enderror" autocomplete="off" value="{{ $product->default_variant->qty ?? old('qty') }}">
                                                        @error('qty')
                                                        <label class="error">{{ $message }}</label>
                                                        @enderror
                                                    </td>
                                                    <td class="v-align-middle p-l-5 p-r-5">
                                                        <input name="selling_price" placeholder="{{ $currency }}" type="text" {{ $required }} class="form-control custom-decimal-field @error('selling_price') error @enderror product-price" autocomplete="off" value="{{ $product->default_variant->selling_price ?? old('selling_price') }}">
                                                        @error('selling_price')
                                                        <label class="error">{{ $message }}</label>
                                                        @enderror
                                                    </td>
                                                    <td class="v-align-middle p-l-5 p-r-5" style="display:none;">
                                                        <input name="compare_price" placeholder="{{ $currency }}" type="text" class="form-control custom-decimal-field @error('compare_price') error @enderror product-cmp-price" autocomplete="off" value="{{ $product->default_variant->compare_price ?? old('compare_price') }}">
                                                        @error('compare_price')
                                                        <label class="error">{{ $message }}</label>
                                                        @enderror
                                                    </td>
                                                    <td class="v-align-middle p-l-5 p-r-5">
                                                        <input name="cost_price" placeholder="{{ $currency }}" type="text" class="form-control custom-decimal-field @error('cost_price') error @enderror product-cost-price" autocomplete="off" value="{{ $product->default_variant->cost_price ?? old('cost_price') }}">
                                                        @error('cost_price')
                                                        <label class="error">{{ $message }}</label>
                                                        @enderror
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Type -->

        <div class="row">
            <!-- Thumbnail -->
            <div class="col-sm-12 col-md-12 col-lg-4 col-xlg-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">
                            Upload - Featured Image <span style="color:tomato">*</span>
                            <span class="pull-right" style="color:tomato">min-width: {{ config('app.config.product_min_width') }}px</span>
                        </div>
                    </div>
                    <div class="card-body no-scroll no-padding">
                        <div class="dropzone dropzone-1 no-margin">
                            <div class="fallback">
                                <input type="file" accept="image/*">
                            </div>
                        </div>
                        <input type="hidden" name="thumbnail" id="thumbnail-image" value="{{ $product->thumbnail->image ?? '' }}">
                    </div>
                    @error('thumbnail')
                    <div class="card-header">
                        <label class="error">{{ $message }}</label>
                    </div>
                    @enderror
                </div>
            </div>
            <!-- Thumbnail-->

            <!-- Gallery Images -->
            <div class="col-sm-12 col-md-12 col-lg-8 col-xlg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">
                            Upload - Gallery Images
                            <span class="pull-right" style="color:tomato">min-width: {{ config('app.config.product_min_width') }}px</span>
                        </div>
                    </div>
                    <div class="card-body no-scroll no-padding">
                        <div class="dropzone dropzone-2 no-margin">
                            <div class="fallback">
                                <input type="file" accept="image/*">
                            </div>
                        </div>
                        <div id="gallery-images">
                            @if($product->gallery_images != null)
                            @foreach ($product->gallery_images as $gallery)
                            @if (Storage::exists('public/product/'.$gallery->image))
                            <input type="hidden" name="gallery[]" value="{{ $gallery->image }}" data-image="{{ $gallery->image }}">
                            @endif
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Gallery Images -->
        </div>

    </form>
</div>
@endsection

@include('modules.ecommerce.product.assets')