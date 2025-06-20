@extends('layouts.app')
@section('title', 'Create Blog')

@section('content')
<div class="container-fluid">
    <form class="m-t-20 blog-form-fix has-hyperlink-search" id="blog-form" role="form" method="POST" action="{{ route('blog.store') }}" data-generate="{{ route('blog.generate.form') }}" data-check="{{ route('blog.check', [0]) }}" data-hyperlink-search="{{ route('web.alias.hyperlink.search', [0]) }}">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 col-xlg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Create Blog
                            <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-l-5 m-r-5 pull-right" type="submit">
                                CREATE <span class="visible-x-inline m-l-5">BLOG</span>
                            </button>
                            <a href="{{ route('blog.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                                <div class="form-group required form-group-default @error('title') has-error @enderror">
                                    <label>Title</label>
                                    <textarea class="form-control alias-source @error('title') error @enderror" name="title" required style="height: 45px;">{{ old('title') }}</textarea>
                                    @error('title')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group form-group-default required input-group alias-edit @error('alias') has-error @enderror">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="pg-icon m-r-5">globe</i>
                                            {{ $website_domain }}
                                        </span>
                                    </div>
                                    <div class="form-input-group">
                                        <input type="text" class="form-control alias-value alias-check p-b-5 @error('alias') error @enderror" name="alias" placeholder="Web Alias" required autocomplete="off" value="{{ old('alias') }}">
                                        <input type="hidden" class="alias-index" name="alias_id" value="0">
                                    </div>
                                </div>
                                @error('alias')
                                <div class="alias-error">
                                    <label class="error">{{ $message }}</label>
                                </div>
                                @enderror
                                <div class="form-group form-group-default @error('subtitle') has-error @enderror">
                                    <label>Subtitle</label>
                                    <textarea class="form-control @error('subtitle') error @enderror" name="subtitle" style="height: 45px;">{{ old('subtitle') }}</textarea>
                                    @error('subtitle')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>

                                <p><strong>BLOG CONTENTS</strong></p>
                                <div class="blog-container content-container">
                                    @php $index = 1; @endphp
                                    @include('includes.addons-description-form', ['index' => $index, 'content' => ''])
                                </div>

                                <div class="blog-tools m-t-15">
                                    <strong class="m-r-15">ADD BLOCKS</strong>

                                    <button class="btn btn-link btn-lg m-b-10 btn-add-content" data-content="description" type="button" data-tippy-content="Description Paragraph" data-tippy-placement="top-start"><i class="pg-icon">text_align_left</i></button>

                                    <button class="btn btn-link btn-lg m-b-10 btn-add-content" data-content="image_gallery" type="button" data-tippy-content="Image Gallery" data-tippy-placement="top-start"><i class="pg-icon">image</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 col-xlg-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">BLOG DETAILS</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group form-group-default input-group required @error('published_at') has-error @enderror">
                            <div class="form-input-group">
                                <label>Publish Date</label>
                                <input type="text" class="form-control published-date @error('published_at') error @enderror" name="published_at" placeholder="Pick a date" autocomplete="off" required value="{{ old('published_at') }}" data-provide="datepicker-inline">
                                @error('published_at')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="pg-icon">calendar</i></span>
                            </div>
                        </div>
                        <div class="form-group form-group-default form-group-default-select2 required @error('category_id') has-error @enderror">
                            <label>Category</label>
                            <select name="category_id" data-init-plugin="select2" class="full-width form-control @error('category_id') error @enderror" required>
                                <option value="" selected>Select Category</option>
                                @forelse ($blog_categories as $category)
                                <option value="{{ $category->id }}" @if(old('category_id')==$category->id) selected @endif>{{ $category->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('category_id')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group form-group-default form-group-default-select2 @error('author_id') has-error @enderror">
                            <label>Author</label>
                            <select name="author_id" data-init-plugin="select2" class="full-width form-control @error('author_id') error @enderror">
                                <option value="" selected>Select Author</option>
                                @forelse ($authors as $author)
                                <option value="{{ $author->id }}" @if(old('author_id')==$author->id) selected @endif>{{ $author->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('author_id')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group form-group-default form-group-tagsinput blog-keywords @error('keywords') has-error @enderror" style="height:100px;">
                            <label>Tags: Type & press enter</label>
                            <input type="text" class="form-control @error('keywords') error @enderror" name="keywords" autocomplete="off" value="{{ old('keywords') }}">
                            @error('keywords')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-check info m-b-10">
                            <input type="checkbox" name="is_active" value="10" id="checkbox-active-1" checked>
                            <label for="checkbox-active-1">Publish ?</label>
                        </div>
                        <div class="row m-t-15">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                                <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media" data-type-media="single" data-populate-value=".populate-value-intro" data-populate-media=".populate-container-intro" id="{{ indexing() }}"><i class="pg-icon m-r-5">image</i> Browse Featured Image</button>
                                @error('intro_image_id')
                                <label class="error">{{ $message }}</label>
                                @enderror
                                <input type="hidden" name="intro_image_id" class="populate-value-intro">
                                <div class="populate-container populate-container-intro m-t-10"></div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                                <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media" data-type-media="single" data-populate-value=".populate-value-banner" data-populate-media=".populate-container-banner" id="{{ indexing() }}"><i class="pg-icon m-r-5">image</i> Browse Banner Image</button>
                                @error('banner_image_id')
                                <label class="error">{{ $message }}</label>
                                @enderror
                                <input type="hidden" name="banner_image_id" class="populate-value-banner">
                                <div class="populate-container populate-container-banner m-t-10"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">SEO / METADATA</div>
                    </div>
                    <div class="card-body">
                        <div class="seo-content">
                            <div class="form-group required form-group-default @error('seo.meta_title') has-error @enderror">
                                <label>Meta Title</label>
                                <textarea class="form-control @error('seo.meta_title') error @enderror" name="seo[meta_title]" placeholder="Meta Title" required style="height:40px;">{{ old('seo.meta_title') }}</textarea>
                                @error('seo.meta_title')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group required form-group-default @error('seo.meta_description') has-error @enderror">
                                <label>Meta Description</label>
                                <textarea class="form-control @error('seo.meta_description') error @enderror" name="seo[meta_description]" placeholder="Meta Description" required style="height:60px;">{{ old('seo.meta_description') }}</textarea>
                                @error('seo.meta_description')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group required form-group-default form-group-tagsinput seo-keywords @error('seo.meta_keywords') has-error @enderror" style="height:100px;">
                                <label>Meta Keywords: Type & press enter</label>
                                <input type="text" class="form-control @error('seo.meta_keywords') error @enderror" name="seo[meta_keywords]" data-role="tagsinput" placeholder="Meta Keywords" required autocomplete="off" value="{{ old('seo.meta_keywords') }}">
                                @error('seo.meta_keywords')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="form-group form-group-default @error('seo.image_alt') has-error @enderror">
                                <label>Meta Image Alt</label>
                                <input type="text" class="form-control @error('seo.image_alt') error @enderror" name="seo[image_alt]" placeholder="Meta Image Alt" autocomplete="off" value="{{ old('seo.image_alt') }}">
                                @error('seo.image_alt')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media" data-type-media="single" data-populate-value=".populate-value-seo" data-populate-media=".populate-container-seo" id="{{ indexing() }}"><i class="pg-icon m-r-5">image</i> Browse Meta Image</button>
                                    @error('seo.meta_image_id')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="row m-t-10">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                                    <input type="hidden" name="seo[meta_image_id]" class="populate-value-seo" value="0">
                                    <div class="populate-container populate-container-seo"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@include('modules.cms.media.use.script')

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('assets/js/alias.use.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/sortable-image.min.js') }}"></script>
<script src="{{ asset('assets/js/summernote-init.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/addons/blog.min.js') }}" type="text/javascript"></script>
@endpush