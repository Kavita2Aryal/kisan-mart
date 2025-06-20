@extends('layouts.app')
@section('title', 'Menu Builder')

@section('content')
<div class="container-fluid menu-builder">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-7 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <div class="card-title full-width">
                        <div>
                            <strong>Desktop Menu Builder</strong>
                            <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5 btn-save">
                                SAVE MENU
                            </button>
                            <input type="hidden" id="menu-type" value="desktop">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul id="menu-builder" class="sortableLists list-group"></ul>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-5 col-lg-5">
            <div class="card-group horizontal" id="accordion">
                @if ($default_pages != null && count($default_pages) > 0)
                <div class="card card-default">
                    <div class="card-header" role="tab">
                        <div class="card-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-default">DEFAULT PAGE</a>
                        </div>
                    </div>
                    <div id="collapse-default" class="collapse">
                        <div class="card-body p-t-10 p-b-10 menu-parent">
                            <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-15 btn-add-selected">
                                <i class="pg-icon">plus</i> ADD SELECTED
                            </button>
                            <div class="menu-listing scroll-ing">
                                @php $i = 0; @endphp
                                @foreach ($default_pages as $key => $dpage)
                                @php $i++; @endphp
                                <div class="form-check complete">
                                    <input type="checkbox" class="menu-check" id="check-dpage-{{ $i }}" data-href="{{ $url.($key == '/' ? '' : $dpage) }}" data-text="{{ $dpage }}" data-target="_self" data-type="default_page" data-index="{{ $i }}" data-image="0">
                                    <label for="check-dpage-{{ $i }}">{{ $dpage }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if ($pages->count() > 0)
                <div class="card card-default">
                    <div class="card-header" role="tab">
                        <div class="card-title">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-page">STANDALONE PAGE</a>
                        </div>
                    </div>
                    <div id="collapse-page" class="collapse">
                        <div class="card-body p-t-10 p-b-10 menu-parent">
                            <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-15 btn-add-selected">
                                <i class="pg-icon">plus</i> ADD SELECTED
                            </button>
                            <div class="menu-listing scroll-ing">
                                @foreach ($pages as $page)
                                <div class="form-check complete">
                                    <input type="checkbox" class="menu-check" id="check-page-{{ $page->id }}" data-href="{{ $url.$page->alias->alias }}" data-text="{{ $page->name }}" data-target="_self" data-type="page" data-index="{{ $page->id }}">
                                    <label for="check-page-{{ $page->id }}">{{ $page->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="card card-default">
                    <div class="card-header" role="tab">
                        <div class="card-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse-custom">ADD / EDIT / CUSTOM MENU</a>
                        </div>
                    </div>
                    <div id="collapse-custom" class="collapse show">
                        <div class="card-body p-t-10 p-b-10">
                            <form class="menu-form">
                                <div class="form-group">
                                    <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-add">
                                        <i class="pg-icon">plus</i> ADD MENU
                                    </button>
                                    <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-update">
                                        <i class="pg-icon">refresh_alt1</i> UPDATE MENU
                                    </button>
                                    <input type="hidden" name="type" id="type" class="item-menu" value="external">
                                    <input type="hidden" name="index" id="index" class="item-menu" value="0">
                                </div>
                                <div class="form-group form-group-default">
                                    <label>Menu Text</label>
                                    <input type="text" name="text" class="form-control item-menu" id="text" autocomplete="off">
                                </div>
                                <div class="form-group form-group-default">
                                    <label>Menu URL</label>
                                    <input type="url" name="href" class="form-control item-menu input-url" id="href" autocomplete="off">
                                </div>
                                <div class="form-group form-group-default input-group">
                                    <div class="form-input-group">
                                        <label>Browser Target</label>
                                        <select name="target" class="form-control item-menu" id="target">
                                            <option value="_self">Self</option>
                                            <option value="_blank">Blank</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row m-b-10">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media m-b-10" data-type-media="single" data-populate-value=".populate-value-menu" data-populate-media=".populate-container-menu" id="menu-index">
                                            <i class="pg-icon m-r-5">image</i> Browse Image
                                        </button>
                                        <input type="hidden" name="image_id" class="populate-value-menu" value="0">
                                        <input type="hidden" name="image" class="item-menu" value="">
                                        <input type="hidden" name="image_preview" class="item-menu" value="">
                                        <div class="populate-container" style="display:none;">
                                            <div class="media-masonry-item" style="margin-bottom:0;">
                                                <div class="media-image">
                                                    <div class="populate-container-menu">
                                                        <div class="populate-media">
                                                            <a href="#" target="_blank">
                                                                <img src="" class="full-width">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="media-options">
                                                    <div class="pull-right">
                                                        <button type="button" class="btn btn-link text-danger remove-use-media-menu">
                                                            <i class="pg-icon">close_lg</i>
                                                        </button>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modules.cms.media.use.script')

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
@endpush

@push('scripts')
<script>
var save_url = "{{ route('menu.store') }}";
var design_data = "{{ $menu_designs->value ?? '' }}";
</script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/menu-builder/menu.editor.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/menu.builder.min.js') }}" type="text/javascript"></script>
@endpush
