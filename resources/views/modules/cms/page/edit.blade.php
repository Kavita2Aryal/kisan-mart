@extends('layouts.app')
@section('title', 'Update Page')

@section('content')
@php $i = 0; @endphp
<div class="container-fluid page-management has-hyperlink-search" 
    data-generate="{{ route('page.generate.form') }}" 
    data-check="{{ route('page.section.check') }}"
    data-hyperlink-search="{{ route('web.alias.hyperlink.search', [$page->uuid]) }}">
    <div class="row m-t-20 m-b-20">
        <div class="col-sm-12 col-md-4 col-lg-4 col-xlg-3">
            <div class="detail-tab content-tab m-b-5" data-index="page--detail" data-section="{{ $i }}">
                <div class="card m-b-0 {{ $active_section == $i ? 'bg-theme' : '' }}">
                    <div class="card-header">
                        <div class="card-title full-width text-center">
                            Page Details
                        </div>
                    </div>
                </div>
            </div>
            @if ($page->header_id > 0)
            @php $header = $headers[$page->header_id]; @endphp
            <div class="header-tab content-tab m-b-0" data-index="page--header">
                <div class="card m-b-0" style="box-shadow: none; border-radius:0;">
                    <div class="card-body p-0">
                        <img src="{{ url('storage/cms/header/'.$header) }}" class="full-width" data-tippy-content="Header {{ $page->header_id }}" data-tippy-placement="top-end">
                    </div>
                </div>
            </div>
            @endif

            @forelse ($page->section_contents as $section)
            @php $i++; $section->setAttribute('indexing', indexing()); @endphp
            <div class="section-tab content-tab m-b-0" data-index="section--{{ $section->indexing }}" data-section="{{ $i }}">
                <div class="card m-b-0 {{ $active_section == $i ? 'bg-theme' : '' }}" style="box-shadow: none; border-radius:0;">
                    <div class="card-body {{ $active_section == $i ? '' : 'p-0' }}">
                        <img src="{{ secure_img_section($section->section_config->section_filename, '768') }}" class="full-width" data-tippy-content="Section {{ $section->section_config->section_index }}" data-tippy-placement="top-end">
                    </div>
                </div>
            </div>
            @empty
            @endforelse

            @if ($page->footer_id > 0)
            @php $footer = $footers[$page->footer_id]; @endphp
            <div class="footer-tab content-tab m-b-0" data-index="page--footer">
                <div class="card m-b-0" style="box-shadow: none; border-radius:0;">
                    <div class="card-body p-0">
                        <img src="{{ url('storage/cms/footer/'.$footer) }}" class="full-width" data-tippy-content="Footer {{ $page->footer_id }}" data-tippy-placement="top-end">
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8 col-xlg-9">
            @php $index = 0; @endphp
            <div class="content-form {{ $active_section == $index ? 'content-active' : '' }}" id="page--detail">
                <form role="form" method="POST" action="{{ route('page.update', [$page->uuid]) }}" id="form-has-alias" data-alias="{{ route('web.alias.check') }}">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title full-width">Page Details
                                <button class="btn btn-link btn-link-fix pull-right m-l-5 p-l-10 p-r-10 m-r-5" type="submit">UPDATE PAGE</button>

                                <a href="{{ route('page.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('modules.cms.page.includes.page_details', ['page' => $page])
                        </div>
                    </div>
                </form>
            </div>
            @forelse ($page->section_contents as $section)
            @php $config = $section->section_config; $index++; @endphp
            <div class="content-form {{ $active_section == $index ? 'content-active' : '' }}" id="section--{{ $section->indexing }}" data-index="{{ $index }}">
                <form role="form" method="POST" action="{{ route('page.section.update', [$section->uuid]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="index" value="{{ $index }}">
                    <div class="card m-b-10">
                        <div class="card-header">
                            <div class="card-title full-width">Page Section - {{ $section->section_name }} - (Section {{ $section->section_config->section_index }})
                                <button class="btn btn-link btn-link-fix pull-right m-l-5 p-l-10 p-r-10 m-r-5 btn-submit" type="submit">UPDATE SECTION</button>

                                <a href="{{ route('page.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('modules.cms.page.includes.section_general', ['section' => $section, 'config' => $config, 'index' => $index])
                        </div>
                    </div>

                    @includeWhen(
                        $config->has_description == 1, 
                        'modules.cms.page.includes.section_description', 
                        ['section' => $section, 'index' => $index]
                    )

                    @includeWhen(
                        $config->has_image == 1, 
                        'modules.cms.page.includes.section_image', 
                        ['section' => $section, 'count' => $config->no_of_images, 'index' => $index]
                    )

                    @includeWhen(
                        $config->has_slider == 1, 
                        'modules.cms.page.includes.section_slider', 
                        ['section' => $section, 'count' => $config->no_of_sliders, 'index' => $index]
                    )

                    @includeWhen(
                        $config->has_video == 1, 
                        'modules.cms.page.includes.section_video', 
                        ['section' => $section, 'count' => $config->no_of_videos, 'index' => $index]
                    )

                    @includeWhen(
                        $config->has_link == 1, 
                        'modules.cms.page.includes.section_link', 
                        ['section' => $section, 'index' => $index]
                    )

                    @includeWhen(
                        $config->has_list == 1, 
                        'modules.cms.page.includes.section_list', 
                        ['section' => $section, 'config' => $config, 'index' => $index]
                    )

                    @includeWhen(
                        $config->has_type == 1, 
                        'modules.cms.page.includes.section_type', 
                        ['section' => $section, 'config' => $config, 'index' => $index]
                    )
                </form>
            </div>
            @empty
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width text-center">No page section available</div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

@include('modules.cms.media.use.script')

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/tippy/light-border.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/radio.css') }}">
@endpush

@push('scripts')
<script>
var option_icons                = @json($icons);
var option_social_media_icons   = @json($social_icons); 
</script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/alias.use.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/icon.picker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/summernote-init.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/page.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/uikit.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/uikit-icons.min.js') }}" type="text/javascript"></script>
@endpush