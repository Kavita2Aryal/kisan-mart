@extends('layouts.app')
@section('title', 'Update Page')

@section('content')
<div class="container-fluid page-management">
    <div class="row m-t-20">
        <div class="col-sm-12 col-md-4 col-lg-4 col-xlg-3">
            @include('modules.cms.page.includes.send_section')
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8 col-xlg-9">
            <form role="form" method="POST" action="{{ route('page.layout.update', [$page->uuid]) }}">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">
                            <div class="row">
                                <div class="col-md-4 col-lg-2">
                                    <input type="range" id="zoomer" min="50" max="100" value="60" data-orientation="horizontal">
                                </div>
                                <div class="col-md-8 col-lg-10">
                                    <button class="btn btn-link btn-link-fix pull-right m-l-5 p-l-10 p-r-10" type="submit" data-type="edit">UPDATE PAGE LAYOUT</button>

                                    <a href="{{ route('page.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body scroll-ing" id="receive-section">
                        <div class="section-container">
                            <div class="text-center section-container-info" style="display: none;">
                                <p class="font-montserrat hint-text m-t-25 m-b-25">drag & drop sections</p>
                            </div>
                            @if ($page->header_id > 0)
                            @php $header = $headers[$page->header_id]; @endphp
                            <div class="header-item content-item">
                                <div>
                                    <img src="{{ url('storage/cms/header/'.$header) }}" class="full-width" data-tippy-content="Header {{ $page->header_id }}" data-tippy-placement="top-end">
                                </div>
                                <div class="content-tools">
                                    <input type="hidden" name="header" value="{{ $page->header_id }}">
                                    <a href="javascript:void(0);" class="normal btn btn-link text-danger btn-remove"><i class="pg-icon">close_lg</i></a>
                                </div>
                            </div>
                            @endif

                            @forelse ($page->section_contents as $section)
                            @php $index = indexing(); @endphp
                            <div class="section-item content-item">
                                <div>
                                    <img src="{{ secure_img_section($section->section_config->section_filename, '768') }}" class="full-width" data-tippy-content="Section {{ $section->section_config->section_index }}" data-tippy-placement="top-end">
                                </div>
                                <div class="content-tools">
                                    <input type="hidden" class="section-id" name="pre_sections[{{ $index }}][id]" value="{{ $section->id }}">
                                    <input type="hidden" class="section-index" name="pre_sections[{{ $index }}][index]" value="{{ $section->section_config->section_index }}">
                                    <input type="hidden" class="section-order" name="pre_sections[{{ $index }}][display_order]" value="{{ $section->display_order }}">
                                    <a href="javascript:void(0);" class="normal btn btn-link text-danger btn-remove"><i class="pg-icon">close_lg</i></a>
                                </div>
                            </div>
                            @empty
                            @endforelse

                            @if ($page->footer_id > 0)
                            @php $footer = $footers[$page->footer_id]; @endphp
                            <div class="footer-item content-item">
                                <div>
                                    <img src="{{ url('storage/cms/footer/'.$footer) }}" class="full-width" data-tippy-content="Footer {{ $page->footer_id }}" data-tippy-placement="top-end">
                                </div>
                                <div class="content-tools">
                                    <input type="hidden" name="footer" value="{{ $page->footer_id }}">
                                    <a href="javascript:void(0);" class="normal btn btn-link text-danger btn-remove"><i class="pg-icon">close_lg</i></a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
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