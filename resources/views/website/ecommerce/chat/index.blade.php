@extends('layout.app')

@section('title')
Chat
@endsection

@push('seo')
{!! SEO::generate(true) !!}
@endpush

@section('frontend-content')
<!-- working body container -->
@include('includes.cms.headers.header_1')

<iframe src="https://tawk.to/chat/5d283902bfcb827ab0cb6aef/default" width="100%" height="590" frameborder="0" allowfullscreen></iframe>
<!-- working body container -->
@endsection

@push('styles')
<style type="text/css">
    .cart-count {
        position: absolute;
        font-size: 8px;
        padding: 0px 2px;
        right: 10px;
        text-align: center;
        width: 10px;
    }
</style>
@endpush

@push('scripts')

@endpush