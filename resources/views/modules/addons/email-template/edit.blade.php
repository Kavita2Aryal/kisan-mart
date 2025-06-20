@extends('layouts.app')
@section('title', 'Update Email Template')

@section('content')
@php $indexing = indexing(); @endphp
<div class="container-fluid">
    <form role="form" class="m-t-20" method="POST" action="{{ route('email.template.update', [$template->uuid]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Update Email Template 
                            <a href="{{ route('email.template.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group required form-group-default @error('title') has-error @enderror">
                            <label>Title</label>
                            <div class="controls">
                                <input type="text" class="form-control @error('title') error @enderror" name="title" value="{{ $template->title ?? old('title') }}">
                                @error('title')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        @can('super.auth')
                        <div class="form-group form-group-default @error('hint') has-error @enderror">
                            <label>Hint</label>
                            <div class="controls">
                                <textarea class="form-control @error('hint') error @enderror" name="hint">{{ $template->hint ?? old('hint') }}</textarea>
                                @error('hint')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        @else 
                        <div class="form-group required form-group-default">
                            <label>Hint</label>
                            <div class="controls">
                                <textarea class="form-control" readonly>{{ $template->hint }}</textarea>
                            </div>
                        </div>
                        @endcan
                        <div class="editor-description parent-section m-b-10 @error('template') has-error @enderror" data-index="{{ $indexing }}">
                            <textarea class="editor-container editor-container-{{ $indexing }} @error('template') error @enderror" name="template">{!! $template->template ?? old('template') !!}</textarea>
                            @error('template')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">EMAIL TEMPLATE</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('assets/js/summernote-init.min.js') }}" type="text/javascript"></script>
<script>summernote_init_simple();</script>
@endpush