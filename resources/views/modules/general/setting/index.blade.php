@extends('layouts.app')
@section('title', 'Web Settings')

@section('content')
<div class="container-fluid"> 
    @include('modules.general.setting.includes.general') 
    @include('modules.general.setting.includes.logo')
    @include('modules.general.setting.includes.generic-seo')  
    @include('modules.general.setting.includes.contact-detail') 
    @include('modules.general.setting.includes.maintenance-mode')
    @include('modules.general.setting.includes.mailchimp')
    @include('modules.general.setting.includes.hotjar')
    @include('modules.general.setting.includes.google-analytics')
    @include('modules.general.setting.includes.chatbot')
    @include('modules.general.setting.includes.third-party')
    @include('modules.general.setting.includes.cache-clear')
</div>

@include('modules.cms.media.use.script')

@endsection

@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}" type="text/javascript"></script>
@endpush