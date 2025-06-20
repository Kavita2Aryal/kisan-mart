@extends('layouts.app')
@section('title', 'Update Author')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" role="form" method="POST" action="{{ route('author.update', [$author->uuid]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Update Author 
                            <a href="{{ route('author.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group form-group-default required @error('name') has-error @enderror">
                            <label>Name</label>
                            <div class="controls">
                                <input type="text" class="form-control @error('name') error @enderror" name="name" autocomplete="off" value="{{ $author->name ?? old('name') }}" required>
                                @error('name')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-group-default @error('description') has-error @enderror">
                            <label>Description</label>
                            <div class="controls">
                                <textarea class="form-control @error('description') error @enderror" name="description"style="height: 120px;">{{ $author->description ?? old('description') }}</textarea>
                                @error('description')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media" data-type-media="single" data-populate-value=".populate-value-author" data-populate-media=".populate-container-author" id="{{ indexing() }}"><i class="pg-icon m-r-5">image</i> Browse Image</button>
                                @error('image_id')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-4">
                                <input type="hidden" name="image_id" class="populate-value-author" value="{{ $author->image_id ?? 0 }}">
                                <div class="populate-container populate-container-author m-b-10">
                                    @if (isset($author->image_id) && isset($author->image->image))
                                    <div class="populate-media">
                                        <a href="{{ secure_img($author->image->image, '1200') }}" target="_blank">
                                            <img src="{{ secure_img($author->image->image, '480X320') }}" class="full-width">
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-check info m-t-0 m-b-0">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" @if($author->is_active==10) checked @endif>
                                    <label for="checkbox-active">Publish ?</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">AUTHOR</span>
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