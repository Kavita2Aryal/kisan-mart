@extends('layouts.app')
@section('title', 'Create Page')

@section('content')
<div class="container-fluid page-management">
    <div class="row m-t-20">
        <div class="col-sm-12 col-md-4 col-lg-4 col-xlg-3">
            @include('modules.cms.page.includes.send_section')
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8 col-xlg-9">
            <form role="form" method="POST" action="{{ route('page.layout.store') }}">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">
                            <div class="row">
                                <div class="col-md-4 col-lg-2">
                                    <input type="range" id="zoomer" min="50" max="100" value="60" data-orientation="horizontal">
                                </div>
                                <div class="col-md-8 col-lg-10">
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-l-5 btn-save-layout-1" type="button">SAVE LAYOUT</button>
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-l-5 btn-submit" type="submit" data-type="add">CREATE PAGE</button>
                                    <a href="{{ route('page.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body scroll-ing" id="receive-section">
                        <div class="section-container">
                            @if ($temp_layout)
                                @if ($temp_layout['header'] > 0 && $headers != null)
                                @php $header = $headers[$temp_layout['header']]; @endphp
                                <div class="header-item content-item">
                                    <div>
                                        <img src="{{ url('storage/cms/header/'.$header) }}" class="full-width" data-tippy-content="Header {{ $temp_layout['header'] }}" data-tippy-placement="top-end">
                                    </div>
                                    <div class="content-tools">
                                        <input type="hidden" name="header" value="{{ $temp_layout['header'] }}">
                                        <a href="javascript:void(0);" class="normal btn btn-link text-danger btn-remove"><i class="pg-icon">close_lg</i></a>
                                    </div>
                                </div>
                                @endif

                                <div class="text-center section-container-info" @if (count($temp_layout['sections']) > 0) style="display: none;" @endif>
                                    <p class="text-uppercase hint-text m-t-25 m-b-25">drag & drop sections</p>
                                </div>

                                @if ($sections != null)
                                @foreach ($temp_layout['sections'] as $sec)
                                @php $section = $sections[$sec['index']]; $index = indexing(); @endphp
                                <div class="section-item content-item">
                                    <div>
                                        <img src="{{ secure_img_section($section['filename'], '768') }}" class="full-width" data-tippy-content="Section {{ $section['index'] }}" data-tippy-placement="top-end">
                                    </div>
                                    <div class="content-tools">
                                        <input type="hidden" class="section-index" name="sections[{{ $index }}][index]" value="{{ $sec['index'] }}">
                                        <input type="hidden" class="section-order" name="sections[{{ $index }}][display_order]" value="{{ $sec['display_order'] }}">
                                        <a href="javascript:void(0);" class="normal btn btn-link text-danger btn-remove"><i class="pg-icon">close_lg</i></a>
                                    </div>
                                </div>
                                @endforeach
                                @endif

                                @if ($temp_layout['footer'] > 0 && $footers != null)
                                @php $footer = $footers[$temp_layout['footer']]; @endphp
                                <div class="footer-item content-item">
                                    <div>
                                        <img src="{{ url('storage/cms/footer/'.$footer) }}" class="full-width" data-tippy-content="Footer {{ $temp_layout['footer'] }}" data-tippy-placement="top-end">
                                    </div>
                                    <div class="content-tools">
                                        <input type="hidden" name="footer" value="{{ $temp_layout['footer'] }}">
                                        <a href="javascript:void(0);" class="normal btn btn-link text-danger btn-remove"><i class="pg-icon">close_lg</i></a>
                                    </div>
                                </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@include('modules.cms.page.includes.modal_save_layout')

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/rangeslider/rangeslider.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/rangeslider/rangeslider.min.js') }}"></script>
<script src="{{ asset('assets/plugins/Sortable/Sortable.min.js') }}"></script>
<script src="{{ asset('assets/js/page.layout.min.js') }}" type="text/javascript"></script>
@endpush