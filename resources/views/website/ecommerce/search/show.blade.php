@extends('layout.app')

@section('title')
Search
@endsection

@push('seo')
@include('includes.seo.seo',
[
'seo' => null,
'url' => url()->current()
]
)
@endpush

@section('frontend-content')
@include('includes.cms.headers.header_1')
<form class="form-search" action="{{ route('search') }}" method="GET">
    <input name="q" type="hidden" value="{{ $search_request_parameter }}" />
    <input type="hidden" name="collection_type" id="filter-collection-type" value="{{ isset($_GET['collection_type']) ? $_GET['collection_type'] : '' }}">
    <input type="hidden" name="collection_name" id="filter-collection-name" value="{{ isset($_GET['collection_name']) ? $_GET['collection_name'] : '' }}">
    <input type="hidden" name="categories" id="filter-category-value" value="{{ isset($_GET['categories']) ? $_GET['categories'] : '' }}">
    <input type="hidden" name="brands" id="filter-brand-value" value="{{ isset($_GET['brands']) ? $_GET['brands'] : '' }}">
    <input type="hidden" name="sizes" id="filter-size-value" value="{{ isset($_GET['sizes']) ? $_GET['sizes'] : '' }}">
    <input type="hidden" name="colors" id="filter-color-value" value="{{ isset($_GET['colors']) ? $_GET['colors'] : '' }}">
    <input type="hidden" class="sort-option" name="sort" value="{{ isset($_GET['sort']) ? $_GET['sort'] : '' }}">
    <input type="hidden" class="hidden-is-min-prange" name="min_prange" value="{{ (isset($_GET['min_prange']) && $_GET['min_prange'] != null) ? $_GET['min_prange'] : '' }}">
    <input type="hidden" class="hidden-is-max-prange" name="max_prange" value="{{ (isset($_GET['max_prange']) && $_GET['max_prange'] != null) ? $_GET['max_prange'] : '' }}">
    <input type="hidden" name="page" class="next-page-value" value="1">
</form>
<div class="uk-section-default uk-section">
    <div class="uk-container uk-container-xlarge">
        <div class="uk-margin-remove-top tm-grid-expand uk-grid-margin uk-margin-remove-top" uk-grid>
            <div class="uk-width-1-5@m">
                <div class="uk-panel uk-position-z-index" uk-sticky="offset: 150; bottom: true; media: @m;">
                    <ul class="uk-list">
                        <li class="el-item">
                            <div class="uk-grid-small uk-child-width-expand uk-flex-nowrap uk-flex-middle" uk-grid>
                                <div class="uk-width-auto"><span class="el-image" uk-icon="icon: settings;"></span></div>
                                <div>
                                    <div class="el-content uk-panel uk-h3">
                                        Filter
                                    </div>
                                </div>
                                @if(!empty($_GET))
                                <div class="uk-text-right">
                                    <a class="el-content uk-label clear-filter" href="javascript:void(0);">Clear Filters</a>
                                </div>
                                @endif
                            </div>
                        </li>
                    </ul>
                    <hr />
                    <div uk-accordion="multiple: 1; collapsible: true;">
                        @if($categories != null)
                            <div class="el-item">
                                <a class="el-title uk-accordion-title" href="javascript:void(0);">Category</a>

                                <div class="uk-accordion-content uk-margin-remove-first-child">
                                    <div class="el-content uk-panel uk-margin-top">
                                        <div class="uk-grid uk-child-width-1-1 uk-grid-small uk-height-large" style="overflow: auto;">
                                        @foreach($categories as $row)
                                            @if(count($row->child) > 0)
                                            <div class="uk-margin-small">
                                                <label>
                                                    <!-- <input class="uk-checkbox category-filter" type="checkbox" value="{!! $row->slug !!}" {{ in_array(($row->slug), $show_filtered_category) ? 'checked' : '' }} />  -->
                                                    <span class="uk-margin-small-left"><strong>{!! $row->name !!}</strong></span></label>
                                                @foreach($row->child as $child)
                                                    <div class="uk-margin-small">
                                                        <label><input class="uk-checkbox category-filter" type="checkbox" value="{!! $child->slug !!}" {{ in_array(($child->slug), $show_filtered_category) ? 'checked' : '' }} /> <span class="uk-margin-small-left">{!! $child->name !!}</span></label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @else
                                            <div class="uk-margin-small">
                                                <label><input class="uk-checkbox category-filter" type="checkbox" value="{!! $row->slug !!}" {{ in_array(($row->slug), $show_filtered_category) ? 'checked' : '' }} /> <span class="uk-margin-small-left"><strong>{!! $row->name !!}</strong></span></label>
                                            </div>
                                            @endif
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($brands != null)
                            @php $brand_arr = array_column($brands->toArray(), 'slug'); @endphp
                            <div class="el-item">
                                <a class="el-title uk-accordion-title" href="javascript:void(0);">Brand</a>

                                <div class="uk-accordion-content uk-margin-remove-first-child">
                                    <div class="el-content uk-panel uk-margin-top">
                                        <div class="uk-grid uk-child-width-1-1 uk-grid-small uk-height-large" style="overflow: auto;">
                                            @foreach($brands as $row)
                                                <div class="uk-margin-small">
                                                <label><input class="uk-checkbox brand-filter" type="checkbox" value="{!! $row->slug !!}" {{ in_array(($row->slug), $show_filtered_brand) ? 'checked' : '' }} /> <span class="uk-margin-small-left"> {!! $row->name !!}</span></label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($color_groups != null && count($color_groups) > 0)
                            <div class="el-item">
                                <a class="el-title uk-accordion-title" href="javascript:void(0);">Color</a>

                                <div class="uk-accordion-content uk-margin-remove-first-child">
                                    <div class="el-content uk-panel uk-margin-top">
                                        <div class="uk-grid uk-child-width-1-1 uk-grid-small uk-height-large" style="overflow: auto;">
                                            @foreach($color_groups as $row)
                                                <div class="uk-margin-small">
                                                <label><input class="uk-checkbox color-filter" type="checkbox" value="{!! $row->slug !!}" {{ in_array(($row->slug), $show_filtered_color) ? 'checked' : '' }} /> <span class="uk-margin-small-left">{!! $row->name !!}</span></label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($sizes != null && count($sizes) > 0)
                            <div class="el-item">
                                <a class="el-title uk-accordion-title" href="javascript:void(0);">Size</a>

                                <div class="uk-accordion-content uk-margin-remove-first-child">
                                    <div class="el-content uk-panel uk-margin-top">
                                        <div class="uk-grid uk-child-width-1-1 uk-grid-small uk-height-large" style="overflow: auto;">
                                            @foreach($sizes as $row)
                                                <div class="uk-margin-small">
                                                <label><input class="uk-checkbox size-filter" type="checkbox" value="{!! $row->value !!}" {{ in_array(($row->value), $show_filtered_size) ? 'checked' : '' }} /> <span class="uk-margin-small-left">{!! $row->value !!}</span></label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="el-item">
                            <a class="el-title uk-accordion-title" href="javascript:void(0);">Price Range</a>

                            <div class="uk-accordion-content uk-margin-remove-first-child">
                                <div class="el-content uk-panel uk-margin-top">
                                    <div class="uk-grid uk-child-width-1-1 uk-grid-small">
                                        <div class="uk-width-expand">
                                            <div class="el-item uk-panel uk-margin-remove-first-child">
                                                <h3 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom"> <span class="uk-align-right sliderValue uk-margin-small-right" data-index="0">{{ (isset($_GET['min_prange']) && $_GET['min_prange'] != null) ? $_GET['min_prange'] : $min_price }}</span> </h3>
                                            </div>
                                        </div>
                                        <div class="uk-width-1-2">
                                            <div class="el-item uk-panel uk-margin-remove-first-child">
                                                <div class="el-content uk-panel">
                                                    <div class="uk-margin">
                                                        <div id="price-range-slider-ui" class="uk-range"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-width-expand">
                                            <div class="el-item uk-panel uk-margin-remove-first-child">
                                                <h3 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom"> <span class="uk-align-left sliderValue uk-margin-small-left" data-index="1">{{ (isset($_GET['max_prange']) && $_GET['max_prange'] != null) ? $_GET['max_prange'] : $max_price }}</span> </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-width-4-5@m">
             @if($search_request_parameter != '')
                <div><div class="el-content uk-panel uk-h3 uk-first-column"><span class="uk-text-middle">Search results for "{{ $search_request_parameter }}"</span></div></div>
                @endif
                @include('includes.product-list', ['products' => $products])
            </div>
        </div>
    </div>
</div>

<div class="uk-section-muted uk-section">
    <div class="uk-container">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div class="uk-width-1-1@m">
                <div id="page#1-0-0-0" class="uk-margin uk-text-left">
                    <div class="uk-child-width-1-1 uk-child-width-1-3@m uk-grid-large uk-grid-match" uk-grid>
                        @if($settings['delivery-status'] == 'ON')
                            <div>
                                <div class="el-item uk-panel uk-margin-remove-first-child" uk-scrollspy="target: [uk-scrollspy-class];">
                                    <div class="uk-child-width-expand" uk-grid>
                                        <div class="uk-width-auto"><img src="{{ url('storage/website/knitted-baby-suit-benefits-01.svg') }}" class="el-image uk-text-emphasis" alt uk-svg /></div>
                                        <div class="uk-margin-remove-first-child">
                                            <h2 class="el-title uk-h6 uk-margin-top uk-margin-remove-bottom">{!! $settings['delivery-title'] !!}</h2>

                                            <div class="el-content uk-panel uk-margin-small-top">{!! $settings['delivery-description'] !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($settings['made-with-love-status'] == 'ON')
                        <div>
                            <div class="el-item uk-panel uk-margin-remove-first-child" uk-scrollspy="target: [uk-scrollspy-class];">
                                <div class="uk-child-width-expand" uk-grid>
                                    <div class="uk-width-auto"><img src="{{ url('storage/website/knitted-baby-suit-benefits-02.svg') }}" class="el-image uk-text-emphasis" alt uk-svg /></div>
                                    <div class="uk-margin-remove-first-child">
                                        <h2 class="el-title uk-h6 uk-margin-top uk-margin-remove-bottom">{!! $settings['made-with-love-title'] !!}</h2>

                                        <div class="el-content uk-panel uk-margin-small-top">{!! $settings['made-with-love-description'] !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($settings['happy-customer-status'] == 'ON')
                        <div>
                            <div class="el-item uk-panel uk-margin-remove-first-child" uk-scrollspy="target: [uk-scrollspy-class];">
                                <div class="uk-child-width-expand" uk-grid>
                                    <div class="uk-width-auto"><img src="{{ url('storage/website/knitted-baby-suit-benefits-03.svg') }}" class="el-image uk-text-emphasis" alt uk-svg /></div>
                                    <div class="uk-margin-remove-first-child">
                                        <h2 class="el-title uk-h6 uk-margin-top uk-margin-remove-bottom">{!! $settings['happy-customer-title'] !!}</h2>

                                        <div class="el-content uk-panel uk-margin-small-top">{!! $settings['happy-customer-description'] !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes.cms.footers.footer_1')
@endsection

@include('includes.product-list-asset')
