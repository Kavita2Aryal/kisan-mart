@extends('layouts.app')
@section('title', 'Create Testimonial')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" role="form" method="POST" action="{{ route('testimonial.store') }}">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Create Testimonial 
                            <a href="{{ route('testimonial.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group form-group-default required @error('name') has-error @enderror">
                                    <label>Name</label>
                                    <input type="text" class="form-control @error('name') error @enderror" name="name" placeholder="Name" autocomplete="off" value="{{ old('name') }}">
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
                                    <input type="text" class="form-control @error('position') error @enderror" name="position" autocomplete="off" value="{{ old('position') }}">
                                    @error('position')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-5">
                                <div class="form-group form-group-default required input-group @error('published_at') has-error @enderror">
                                    <div class="form-input-group">
                                        <label>Publish Date</label>
                                        <input type="text" class="form-control @error('published_at') error @enderror" name="published_at" required autocomplete="off" value="{{ old('published_at') }}" data-provide="datepicker-inline">
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
                            <input type="text" class="form-control @error('title') error @enderror" name="title" autocomplete="off" value="{{ old('title') }}">
                            @error('title')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group form-group-default required @error('description') has-error @enderror">
                            <label>Description</label>
                            <textarea class="form-control @error('description') error @enderror" required name="description" style="height: 100px;">{{ old('description') }}</textarea>
                            @error('description')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media" data-type-media="single" data-populate-value=".populate-value-testimonial" data-populate-media=".populate-container-testimonial" id="{{ indexing() }}"><i class="pg-icon m-r-5">image</i> Browse Image</button>
                                @error('image_id')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-4">
                                <input type="hidden" name="image_id" class="populate-value-testimonial" value="0">
                                <div class="populate-container populate-container-testimonial m-b-10">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-check info m-t-0 m-b-0">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" checked>
                                    <label for="checkbox-active">Publish ?</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    CREATE <span class="visible-x-inline m-l-5">TESTIMONIAL</span>
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