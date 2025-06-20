@extends('layouts.app')
@section('title', 'Update Testimonial')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" role="form" method="POST" action="{{ route('testimonial.update', [$testimonial->uuid]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Update Testimonial 
                            <a href="{{ route('testimonial.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group form-group-default required @error('name') has-error @enderror">
                                    <label>Name</label>
                                    <input type="text" class="form-control @error('name') error @enderror" name="name" autocomplete="off" value="{{ $testimonial->name ?? old('name') }}">
                                    @error('name')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-7">
                                <div class="form-group form-group-default required @error('position') has-error @enderror">
                                    <label>Position</label>
                                    <input type="text" class="form-control @error('position') error @enderror" name="position" autocomplete="off" value="{{ $testimonial->position ?? old('position') }}">
                                    @error('position')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5">
                                <div class="form-group form-group-default required input-group @error('published_at') has-error @enderror">
                                    <div class="form-input-group">
                                        <label>Publish Date</label>
                                        <input type="text" class="form-control @error('published_at') error @enderror" name="published_at" required autocomplete="off" value="{{ $testimonial->published_at ?? old('published_at') }}" data-provide="datepicker-inline">
                                        @error('published_at')
                                            <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="pg-icon">calendar</i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-default required @error('title') has-error @enderror">
                            <label>Title</label>
                            <input type="text" class="form-control @error('title') error @enderror" name="title" autocomplete="off" value="{{ $testimonial->title ?? old('title') }}">
                            @error('title')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group required form-group-default @error('description') has-error @enderror">
                            <label>Description</label>
                            <textarea class="form-control @error('description') error @enderror" required name="description" style="height: 120px;">{{ $testimonial->description ?? old('description') }}</textarea>
                            @error('description')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media" data-populate-value=".populate-value-testimonial" data-populate-media=".populate-container-testimonial" id="{{ indexing() }}"><i class="pg-icon m-r-5">image</i> Browse Image</button>
                                @error('image_id')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                                <input type="hidden" name="image_id" class="populate-value-testimonial" value="{{ $testimonial->image_id }}">
                                <div class="populate-container populate-container-testimonial m-b-10">
                                    @if ($testimonial->image_id > 0 && isset($testimonial->image->image))
                                    <div class="populate-media">
                                        <a href="{{ secure_img($testimonial->image->image, '1200') }}" target="_blank">
                                            <img src="{{ secure_img($testimonial->image->image, '480X320') }}" class="full-width">
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-check info m-t-0 m-b-0">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" @if($testimonial->is_active==10) checked @endif>
                                <label for="checkbox-active">Publish ?</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">TESTIMONIAL</span>
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
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush