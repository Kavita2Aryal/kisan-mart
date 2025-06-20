@extends('layouts.app')
@section('title', 'Update Page Test')

@section('content')
@php $i = 0; @endphp
<div class="container-fluid page-management" data-generate="{{ route('page.generate.form') }}" data-check="{{ route('page.section.check') }}">
    <div class="row m-t-10 m-b-10">
        <div class="col-sm-12 col-md-4 col-lg-4 col-xlg-3">
            <div class="view-port clearfix" id="content--form">
                <div class="view">
                    <div class="navbar navbar-default">
                        <div class="navbar-inner">
                            <div class="action">
                                <a href="{{ route('page.index') }}" class="btn btn-link">
                                    <i class="pg-icon">arrow_left</i>
                                </a>
                            </div>
                            <div class="m-l-35">
                                <a href="javascript:;" class="btn btn-link" data-view-animation="push-parrallax" data-view-port="#content--form" data-navigate="view" data-toggle-view="#page--detail--push">
                                    {{ $page->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($page->header_id > 0)
                    @php $header = $headers[$page->header_id]; @endphp
                    <div class="header-tab card m-b-0" style="box-shadow: none; border-radius:0;">
                        <div class="card-body p-0">
                            <img src="{{ url('storage/cms/header/'.$header['filename']) }}" class="full-width" data-tippy-content="Header {{ $page->header_id }}" data-tippy-placement="top-end">
                        </div>
                    </div>
                    @endif

                    @forelse ($page->section_contents as $section)
                    @php $i++; $section->setAttribute('indexing', indexing()); @endphp
                    <div class="card m-b-0" style="box-shadow: none; border-radius:0;"
                        data-view-animation="push-parrallax" data-view-port="#content--form" data-navigate="view" data-toggle-view="#section--{{ $section->indexing }}--push">
                        <div class="card-body p-0">
                            <img src="{{ url('storage/cms/section/'.$section->section_config->section_filename) }}" class="full-width" data-tippy-content="Section {{ $section->section_config->section_index }}" data-tippy-placement="top-end">
                        </div>
                    </div>
                    @empty
                    @endforelse

                    @if ($page->footer_id > 0)
                    @php $footer = $footers[$page->footer_id]; @endphp
                    <div class="card m-b-0 footer-tab" style="box-shadow: none; border-radius:0;">
                        <div class="card-body p-0">
                            <img src="{{ url('storage/cms/footer/'.$footer['filename']) }}" class="full-width" data-tippy-content="Footer {{ $page->footer_id }}" data-tippy-placement="top-end">
                        </div>
                    </div>
                    @endif
                </div>
                <div class="view chat-view bg-white clearfix">
                    <div class="view chat-view bg-white clearfix" id="page--detail--push">
                        <form role="form" method="POST" action="{{ route('page.update', [$page->uuid]) }}" id="form-has-alias" data-alias="{{ route('web.alias.check') }}">
                            @csrf
                            @method('PUT')
                            <div class="navbar navbar-default">
                                <div class="navbar-inner">
                                    <div class="action">
                                        <a href="{{ route('page.index') }}" class="btn btn-link" data-navigate="view" data-view-port="#content--form" data-view-animation="push-parrallax">
                                            <i class="pg-icon">arrow_left</i>
                                        </a>
                                    </div>
                                    <div class="m-l-35">Page Details Test</div>
                                    <div class="action pull-right">
                                        <button type="submit" class="btn btn-link">SAVE</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card m-b-0">
                                <div class="card-body">
                                    @include('modules.cms.page.includes.page_details', ['page' => $page, 'media_path' => $media_path])
                                </div>
                            </div>
                        </form>
                    </div>
                    @php $index = 0; @endphp
                    @forelse ($page->section_contents as $section)
                    @php $config = $section->section_config; $index++; @endphp
                    <div class="view chat-view bg-white clearfix" id="section--{{ $section->indexing }}--push">
                        <form class="content-form content-active" role="form" method="POST" action="{{ route('page.section.update', [$section->uuid]) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="index" value="{{ $index }}">
                            <div class="navbar navbar-default">
                                <div class="navbar-inner">
                                    <div class="action">
                                        <a href="javascript:;" class="btn btn-link" data-navigate="view" data-view-port="#content--form" data-view-animation="push-parrallax">
                                            <i class="pg-icon">arrow_left</i>
                                        </a>
                                    </div>
                                    <div class="m-l-35">
                                        {{ $section->section_name }} - (Section {{ $section->section_config->section_index }})
                                    </div>
                                    <div class="action pull-right">
                                        <button type="submit" class="btn btn-link">SAVE</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card m-b-10 m-t-10">
                                <div class="card-header">
                                    <div class="card-title">Section Title(s)</div>
                                    <div class="card-controls">
                                        <ul>
                                            <li>
                                                <a href="#" class="btn-collapse" data-target=".section-title-parent-{{ $index }}"><i class="pg-icon">chevron_up</i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body section-title-parent-{{ $index }}">
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
        <div class="col-sm-12 col-md-8 col-lg-8 col-xlg-9">
            <iframe src="http://kisanmart.com.np/" title="Website Preview" frameborder="0" style="position: relative; height: 100%; width: 100%;"></iframe>
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
var option_social_media_icons   = @json($social_media_icons);
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