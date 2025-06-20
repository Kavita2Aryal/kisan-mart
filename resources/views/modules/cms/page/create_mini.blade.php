@extends('layouts.app')
@section('title', 'Create Page')

@section('content')
<div class="container-fluid page-management">
    <div class="row m-t-20">
        <div class="col-sm-12 col-md-4 col-lg-4 col-xlg-3 m-b-20">
            <div class="detail-tab content-tab m-b-5">
                <div class="card m-b-0 bg-theme">
                    <div class="card-header">
                        <div class="card-title full-width text-center">
                            Page Details
                        </div>
                    </div>
                </div>
            </div>
            @if ($temp_layout['header'] > 0)
            @php $header = $headers[$temp_layout['header']]; @endphp
            <div class="header-tab content-tab m-b-0">
                <div class="card m-b-0" style="box-shadow: none; border-radius:0;">
                    <div class="card-body p-0">
                        <img src="{{ url('storage/cms/header/'.$header) }}" class="full-width" data-tippy-content="Header {{ $temp_layout['header'] }}" data-tippy-placement="top-end">
                    </div>
                </div>
            </div>
            @endif

            @forelse ($temp_layout['sections'] as $sec)
            @isset($sections[$sec])
            @php $section = $sections[$sec]; @endphp
            <div class="section-tab content-tab m-b-0">
                <div class="card m-b-0" style="box-shadow: none; border-radius:0;">
                    <div class="card-body p-0">
                        <img src="{{ secure_img_section($section['filename'], '768') }}" class="full-width" data-tippy-content="Section {{ $section['index'] }}" data-tippy-placement="top-end">
                    </div>
                </div>
            </div>
            @endisset
            @empty
            @endforelse

            @if ($temp_layout['footer'] > 0)
            @php $footer = $footers[$temp_layout['footer']]; @endphp
            <div class="footer-tab content-tab m-b-0">
                <div class="card m-b-0" style="box-shadow: none; border-radius:0;">
                    <div class="card-body p-0">
                        <img src="{{ url('storage/cms/footer/'.$footer) }}" class="full-width" data-tippy-content="Footer {{ $temp_layout['footer'] }}" data-tippy-placement="top-end">
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8 col-xlg-9">
            <div class="content-form content-active">
                <form role="form" method="POST" action="{{ route('page.mini.store') }}" id="form-has-alias" data-alias="{{ route('web.alias.check') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title full-width">Page Details
                                <button class="btn btn-link btn-link-fix pull-right m-l-5 p-l-10 p-r-10 m-r-5" type="submit">CREATE PAGE</button>

                                <a href="{{ route('page.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('modules.cms.page.includes.page_details', ['page' => ''])
                            
                            <input type="hidden" name="header" value="{{ $temp_layout['header'] ?? 0 }}">
                            <input type="hidden" name="footer" value="{{ $temp_layout['footer'] ?? 0 }}">
                            
                            @php $ix=0; @endphp
                            @forelse ($temp_layout['sections'] as $sec)
                            @php $index = indexing(); $ix++; @endphp
                            <input type="hidden" name="sections[{{ $index }}][index]" value="{{ $sec }}">
                            <input type="hidden" name="sections[{{ $index }}][display_order]" value="{{ $ix }}">
                            @empty
                            @endforelse
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('modules.cms.media.use.script')

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-tag/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/js/alias.use.min.js') }}" type="text/javascript"></script>
<script>
$(document)
.on('click', '.content-tab', function (e) { e.preventDefault();
    if (!$(this).hasClass('detail-tab')) notify_bar('danger', 'Please create a page before proceeding.');
});
</script>
@endpush