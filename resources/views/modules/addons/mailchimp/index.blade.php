@extends('layouts.app')
@section('title', 'Send With Mailchimp')

@section('content')
@php $indexing = indexing(); @endphp
<div class="container-fluid">
    <form role="form" class="m-t-20 has-hyperlink-search" method="POST" action="{{ route('mailchimp.compose.email') }}"
    data-hyperlink-search="{{ route('web.alias.hyperlink.search', [0]) }}">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Compose Email 
                            <a href="{{ route('newsletter.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                        <div class="row"><div class="col-sm-12 col-md-6 col-lg-6">Send Emails to all your clients/auidence listed on your mailchimp account.</div></div>
                    </div>
                    <div class="card-body">
                        <div class="row m-t-10">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group required form-group-default @error('from_email') has-error @enderror">
                                    <label>From Email</label>
                                    <div class="controls">
                                        <input type="email" class="form-control @error('from_email') error @enderror" name="from_email" value="{{ get_setting('admin-email') ?? old('from_email') }}" readonly required>
                                        @error('from_email')
                                        <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group required form-group-default @error('from_name') has-error @enderror">
                                    <label>From Name</label>
                                    <div class="controls">
                                        <input type="text" class="form-control @error('from_name') error @enderror" name="from_name" value="{{ old('from_name') }}" required>
                                        @error('from_name')
                                        <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group required form-group-default @error('subject') has-error @enderror">
                                    <label>Subject</label>
                                    <div class="controls">
                                        <input  type="text" class="form-control @error('subject') error @enderror" name="subject" value="{{ old('subject') }}" required>
                                        @error('subject')
                                        <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="editor-description parent-section m-b-10 @error('body') has-error @enderror" data-index="{{ $indexing }}">
                            <textarea class="editor-container editor-container-{{ $indexing }} @error('body') error @enderror" name="body">{!! old('body') !!}</textarea>
                            @error('body')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    SEND <span class="visible-x-inline m-l-5">EMAIL</span>
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
<script>summernote_init();</script>
@endpush