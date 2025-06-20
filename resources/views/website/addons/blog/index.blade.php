@extends('layout.app')

@section('title')
Blog
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
<div class="uk-section-default uk-section uk-section-xsmall uk-padding-remove-bottom" tm-header-transparent="dark">
    <div class="uk-container uk-container-xlarge">
        <div class="tm-header-placeholder uk-margin-remove-adjacent"></div>
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div class="uk-width-1-1@m">
                <div>
                    <ul class="uk-breadcrumb uk-margin-remove-bottom">
                        <li><a href="{{ route('home') }}">Home</a></li>

                        <li><span>Blog</span></li>
                    </ul>
                </div>
                <hr />
            </div>
        </div>
    </div>
</div>

@if(!$blogs->isEmpty())
    <div class="uk-section-default uk-section">
        <div class="uk-container uk-container-large">
            <div class="uk-grid-margin uk-container uk-container-large">
                <div class="tm-grid-expand uk-grid-divider" uk-grid>
                    <div class="uk-width-3-5@m">
                        <div class="uk-margin">
                            <div class="uk-child-width-1-1 uk-child-width-1-3@s uk-child-width-1-1@l uk-grid-column-small uk-grid-divider uk-grid-match"
                                uk-grid>
                                @foreach($blogs as $row)
                                <div>
                                    <div class="el-item uk-panel uk-margin-remove-first-child">
                                        <div class="uk-child-width-expand" uk-grid>
                                            <div class="uk-width-1-3@l">
                                                <a href="{!! $row->alias->alias !!}">
                                                    <img class="el-image lozad hw-197" alt
                                                        data-src="{{ secure_img($row->intro_image->image, 'main') }}" uk-img />
                                                </a>
                                            </div>
                                            <div class="uk-margin-remove-first-child">
                                                @if($row->author != null)
                                                    <div
                                                        class="el-meta uk-h6 uk-text-primary uk-margin-top uk-margin-remove-bottom">
                                                        BY {!! $row->author->name !!}
                                                    </div>
                                                @endif
                                                <h2
                                                    class="el-title uk-h3 uk-margin-small-top uk-margin-remove-bottom">
                                                    <a href="{!! $row->alias->alias !!}" class="uk-link-heading">{!! $row->title !!}</a>
                                                </h2>

                                                @if($row->contents->count() > 0)
                                                    @if($row->contents[0]->display_type == 1)
                                                        <div class="el-content uk-panel uk-margin-small-top">
                                                            {!! Str::limit($row->contents[0]->description, 150) !!}
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tm-grid-expand uk-child-width-1-1 uk-margin-large" uk-grid>
                <div>
                    <div class="uk-panel uk-margin uk-text-center">
                        @include('includes.paginate', ['data' => $blogs])
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
<div class="uk-section-default uk-section">
    <div class="uk-container">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div>
                <h3 class="uk-font-secondary uk-width-xlarge@m">No Blogs!</h3>
            </div>
        </div>
    </div>
</div>
@endif
@include('includes.cms.footers.footer_1')
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush