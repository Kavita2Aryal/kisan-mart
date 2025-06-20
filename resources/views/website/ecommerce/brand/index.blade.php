@extends('layout.app')

@section('title')
Brands
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
<div class="uk-section">
    <div class="uk-container">
        <div class="tm-grid-expand uk-grid-margin uk-grid uk-grid-stack" uk-grid="">
            <div class="uk-first-column">
                <h1 class="uk-h1 uk-margin-medium uk-text-center">Brands</h1>
                <div class="uk-margin">
                    <div class="uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-5@m uk-grid-medium uk-grid-match uk-grid" uk-grid="">
                        @foreach($brands as $brand)
                            @if($brand->image != null)
                                <div>
                                    <a class="el-item uk-card uk-card-default uk-card-hover uk-card-body uk-margin-remove-first-child uk-transition-toggle uk-link-toggle uk-display-block uk-text-center" href="/search?brands={{$brand->slug}}">
                                        <div class="uk-inline-clip">
                                            <img
                                                class="el-image uk-transition-scale-up uk-transition-opaque lozad"
                                                alt
                                                data-src="{{ secure_img_ecom($brand->image, 'main') }}"
                                                uk-img
                                                src="{{ secure_img_ecom($brand->image, 'main') }}"
                                            />
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.cms.footers.footer_1')
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
