@extends('layouts.app')
@section('title', 'Update Popup')

@section('content')
@php $indexing = indexing(); @endphp
<div class="container-fluid">
    <form class="m-t-20 has-hyperlink-search" role="form" method="POST" action="{{ route('popup.update', [$popup->uuid]) }}"
    data-hyperlink-search="{{ route('web.alias.hyperlink.search', [0]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Update Popup 
                            <a href="{{ route('popup.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group form-group-default required @error('title') has-error @enderror">
                            <label>Title</label>
                            <div class="controls">
                                <input type="text" class="form-control @error('title') error @enderror" name="title" autocomplete="off" value="{{ $popup->title ?? old('title') }}">
                                @error('title')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group required form-group-default form-group-default-select2 @error('pages') has-error @enderror">
                            <label>Assign to Pages</label>
                            <select name="pages[]" class="full-width form-control get-hyperlink-page @error('pages') error @enderror" required multiple>
                                @if ($popup->pages != null)
                                @foreach ($popup->pages as $page)
                                <option value="{{ $page->id }}" selected>{{ $page->name }}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('page_id')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="editor-description parent-section m-b-10" data-index="{{ $indexing }}">
                            <textarea class="editor-container editor-container-{{ $indexing }} @error('description') error @enderror" name="description">{{ $popup->description ?? old('description') }}</textarea>
                            @error('description')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group form-group-default @error('video') has-error @enderror">
                            <label>Video Link</label>
                            <div class="controls">
                                <input type="url" class="form-control @error('video') error @enderror" name="video" placeholder="Video Link" autocomplete="off" value="{{ $popup->video_link ?? old('video') }}">
                                @error('video')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-group-default @error('external') has-error @enderror">
                            <label>External Link</label>
                            <div class="controls">
                                <input type="url" class="form-control @error('external') error @enderror" name="external" placeholder="External Link" autocomplete="off" value="{{ $popup->external_link ?? old('external') }}">
                                @error('external')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media" data-type-media="single" data-populate-value=".populate-value-popup" data-populate-media=".populate-container-popup" id="{{ indexing() }}"><i class="pg-icon m-r-5">image</i> Browse Image</button>
                                @error('image_id')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-4">
                                <input type="hidden" name="image_id" class="populate-value-popup" value="{{ $popup->image_id ?? 0 }}">
                                <div class="populate-container populate-container-popup m-b-10">
                                    @if (isset($popup->image_id) && isset($popup->image->image))
                                    <div class="populate-media">
                                        <a href="{{ secure_img($popup->image->image, '1200') }}" target="_blank">
                                            <img src="{{ secure_img($popup->image->image, '480X320') }}" class="full-width">
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-check info m-t-0 m-b-0">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" @if($popup->is_active==10) checked @endif>
                                    <label for="checkbox-active">Publish ?</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">POPUP</span>
                                </button>
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
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('assets/js/summernote-init.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/assign-page.min.js') }}" type="text/javascript"></script> 
<script>summernote_init();</script>
@endpush