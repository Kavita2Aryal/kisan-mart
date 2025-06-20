@extends('layouts.app')
@section('title', 'Create Slider')

@section('content')
<div class="container-fluid slider-management">
    <div class="row m-t-20">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
            <form role="form" method="POST" action="{{ route('slider.store') }}" data-generate="{{ route('slider.generate.form') }}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <button class="btn btn-link btn-link-fix pull-right m-l-5 p-l-10 p-r-10" data-toggle="modal" data-target=".modal-slider-save" type="button">CREATE SLIDER</button>

                                    <button class="btn btn-link btn-link-fix pull-right m-l-5 p-l-10 p-r-10 btn-add-slide-item" data-type="image" type="button">
                                        <span class="visible-x-inline m-r-5">ADD</span> IMAGE
                                        <span class="visible-x-inline m-l-5">SLIDE</span>
                                    </button>

                                    <button class="btn btn-link btn-link-fix pull-right m-l-5 p-l-10 p-r-10 btn-add-slide-item" data-type="video" type="button">
                                        <span class="visible-x-inline m-r-5">ADD</span> VIDEO
                                        <span class="visible-x-inline m-l-5">SLIDE</span>
                                    </button>

                                    <a href="{{ route('slider.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body scroll-ing slider-container row-slide">
                        <div class="text-center slider-container-info">
                            <p class="font-montserrat hint-text">add image or video slides</p>
                        </div>
                    </div>
                </div>
                @include('modules.cms.slider.includes.modal_save', ['slider_name' => ''])
            </form>
        </div>
    </div>
</div>

@include('modules.cms.media.use.script')

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/slider.min.js') }}" type="text/javascript"></script>
@endpush