@extends('layouts.app')

@section('title', 'Update Category')

@section('content')
@php $uuid = $category->uuid; @endphp
<div class="container-fluid">
    <form class="m-t-20" id="form" role="form" method="POST" action="{{ route('category.update', [$uuid]) }}" data-hyperlink-search="{{ route('web.alias.hyperlink.search', [$uuid]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-7 col-xlg-7">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Update Category
                            <a href="{{ route('category.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group required form-group-default @error('name') has-error @enderror">
                            <label>Category Name</label>
                            <div class="controls">
                                <input name="name" type="text" class="form-control alias-source @error('name') error @enderror" required autocomplete="off" value="{{ $category->name ?? old('name') }}">
                                @error('name')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-group-default required input-group alias-edit @error('alias') has-error @enderror">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="pg-icon m-r-5">globe</i>
                                    {{ $url.'categories/' }}
                                </span>
                            </div>
                            <div class="form-input-group">
                                @php 
                                    $alias = explode('/', $category->alias->alias);
                                @endphp
                                <input type="text" class="form-control alias-value alias-check p-b-5 @error('alias') error @enderror" name="alias" placeholder="Web Alias" required autocomplete="off" value="{{ $alias[1] ?? old('alias') }}">
                                <input type="hidden" class="alias-index" name="alias_id" value="{{ $category->alias->id }}">
                            </div>
                        </div>
                        @error('alias')
                        <div class="alias-error">
                            <label class="error">{{ $message }}</label>
                        </div>
                        @enderror
                        <div class="form-group form-group-default input-group">
                            <div class="form-input-group">
                                <label>Parent Category</label>
                                <select class="full-width form-control category-prod" name="parent_category" data-placeholder="Select a Parent Category" tabindex="-1" aria-hidden="true">
                                    <option value="" selected>Select a Parent Category</option>
                                    @forelse ($categories as $row)
                                    <option value="{{ $row->id }}" {{ $row->id == ($category->parent_id) ? 'selected' : '' }}>{{ $row->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        @php $indexing = indexing(); @endphp
                        <div class="form-group editor-description @error('description') has-error @enderror" data-index="{{ $indexing }}">
                            <textarea class="editor-container editor-container-{{ $indexing }} @error('description') error @enderror" name="description">{{ $category->description ?? old('description') }}</textarea>
                            @error('description')
                            <label class="error">{{ $errors->first('description') }}</label>
                            @enderror
                        </div>
                        <div class="form-group form-group-default form-group-default-select2 @error('products') has-error @enderror">
                            <label>Assign Products To Display On Website</label>
                            <select class="full-width @error('products') error @enderror product-lists" name="products[]" data-placeholder="Assign Products" data-init-plugin="select2" multiple>
                                @if ($product_lists != null)
                                    @foreach($product_lists as $key => $row)
                                        <option value="{{ $key }}" selected>{{ $row }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('products')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-check info m-t-0 m-b-0">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" @if($category->is_active == 10) checked @endif>
                                    <label for="checkbox-active">Publish ?</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-submit" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">CATEGORY</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-5 col-xlg-5">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Upload - Category Image
                        </div>
                    </div>
                    <div class="card-body no-scroll no-padding">
                        <div class="dropzone no-margin">
                            <div class="fallback">
                                <input type="file" accept="image/*">
                            </div>
                        </div>
                        <input type="hidden" name="image" class="category-image" value="{{ $category->image ?? old('image') }}" />
                    </div>
                </div>
                @if ($errors->has('image'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection

@include('modules.ecommerce.category.assets')