@extends('layout.app')

@section('title')
{!! $blog->title !!}
@endsection

@push('seo')
@include('includes.seo.seo',
[
'seo' => $blog->seo,
'url' => url()->current()
]
)
@endpush

@section('frontend-content')
@include('includes.cms.headers.header_1')
<div class="uk-section-default uk-section uk-section-large" tm-header-transparent="dark">
    <div class="tm-header-placeholder uk-margin-remove-adjacent"></div>
    <div class="uk-grid-margin uk-container uk-container-xsmall">
        <div class="tm-grid-expand uk-child-width-1-1" uk-grid>
            <div class="uk-width-1-1@m">
                <div class="uk-panel uk-text-meta uk-margin-remove-vertical uk-text-center"><time datetime="2016-09-20T08:58:32+00:00">{{ date('j F, Y', strtotime($blog->published_at)) }}</time></div>
                <h1 class="uk-heading-small uk-margin-small uk-text-center">{!! $blog->title !!}</h1>
                <hr class="uk-divider-small uk-text-center" />
                @if($blog->author != null)
                <h6 class="uk-h6 uk-margin-small uk-text-center">By {!! $blog->author->name !!}</h6>
                @endif
            </div>
        </div>
    </div>
    @if($blog->intro_image != null)
    <div class="uk-margin-large uk-container">
        <div class="tm-grid-expand uk-child-width-1-1" uk-grid>
            <div class="uk-width-1-1@m">
                <div>
                    <img class="el-image lozad uk-box-shadow-large" alt src="{{ secure_img($blog->intro_image->image, 'main') }}" uk-img />
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="uk-grid-margin uk-container uk-container-xsmall">
        <div class="tm-grid-expand uk-child-width-1-1" uk-grid>
            <div class="uk-width-1-1@m">
                <div class="uk-panel">
                    @if($blog->subtitle != null)
                    <p class="uk-text-lead">
                        {!! $blog->subtitle !!}
                    </p>
                    @endif

                    @foreach($blog->contents as $content)
                    @if($content->display_type == 1)
                    {!! $content->description!!}
                    @endif
                    @if($content->display_type == 2)
                    <div class="uk-margin-top">
                        @foreach($content->image_gallery() as $image)
                        <p class="uk-margin-medium">
                            <img data-src="{{ secure_img($image->image, 'main') }}" width="750" height="450" alt="" uk-img />
                        </p>
                        @endforeach
                    </div>
                    @endif
                    @if($content->type == 3)
                    @php $video = get_youtube_video_id($content->video_url); $url = "https://www.youtube.com/embed/".$video; @endphp
                    <iframe src="{{ $url }}" width="1080" height="608" frameborder="0" uk-video allowfullscreen></iframe>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @if($blog->author != null)
    <div class="uk-grid-margin uk-container uk-container-xsmall">
        <div class="tm-grid-expand uk-child-width-1-1" uk-grid>
            <div>
                <div class="uk-panel uk-margin-remove-first-child uk-margin uk-text-left@s uk-text-center">
                    <div class="uk-child-width-expand uk-grid-small uk-flex-middle" uk-grid>
                        @if($blog->author->image_id != null && $blog->author->image != null)
                        <div class="uk-width-auto@s">
                            <a href="{{ secure_img($blog->author->image->image, 'main') }}">
                                <img class="el-image lozad uk-border-circle uk-box-shadow-small hw-50" alt src="{{ secure_img($blog->author->image->image, 'main') }}" uk-img />
                            </a>
                        </div>
                        @endif
                        <div class="uk-margin-remove-first-child">
                            <div class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom"><a href="#" class="uk-link-reset">{!! $blog->author->name !!}</a></div>
                            <div class="el-meta uk-h5 uk-text-muted uk-margin-remove-bottom uk-margin-remove-top">
                                {!! $blog->author->profession !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="uk-section-default uk-section">
    <div class="uk-container uk-container-large">
        <div class="tm-grid-expand uk-grid-margin" uk-grid>
            <div class="uk-width-1-2@m uk-visible@s">
                <div class="uk-visible@s uk-margin">
                    <a class="el-content uk-button uk-button-default" href="{{ route('blog.index') }}">
                        Back to Blog
                    </a>
                </div>
            </div>

            <div class="uk-width-1-2@m">
                <div class="uk-margin uk-text-right@s uk-text-center">
                    <div class="uk-flex-middle uk-grid-small uk-child-width-auto uk-flex-right@s uk-flex-center" uk-grid>
                        @if($prev_url != null)
                        <div class="el-item">
                            <a class="el-content uk-button uk-button-default" href="{{ $prev_url }}">
                                <span uk-icon="chevron-left"></span>
                                <span class="uk-text-middle">PREVIOUS </span>
                            </a>
                        </div>
                        @endif
                        @if($next_url != null)
                        <div class="el-item">
                            <a class="el-content uk-button uk-button-default" href="{{ $next_url }}">
                                <span class="uk-text-middle">NEXT </span>

                                <span uk-icon="chevron-right"></span>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="uk-section-default uk-section" uk-scrollspy="target: [uk-scrollspy-class]; cls: uk-animation-fade; delay: false;">
    <div class="uk-container uk-container-large">
        <div class="tm-grid-expand uk-grid-collapse uk-child-width-1-1" uk-grid>
            <div class="uk-grid-item-match">
                <div class="uk-tile-muted uk-flex">
                    <div class="uk-tile uk-width-1-1 uk-tile-large uk-flex uk-flex-middle uk-background-norepeat uk-background-bottom-right" data-src="{{ url('storage/website/floral.png') }}" uk-img>
                        <div class="uk-panel uk-width-1-1">
                            <div class="uk-margin uk-width-xlarge uk-margin-auto" uk-scrollspy-class>
                                <img class="el-image lozad" alt src="{{ url('storage/website/shopbag.png') }}" uk-img />
                            </div>
                            @if($settings['essential-status'] == 'ON')
                                <h2 class="uk-h1 uk-width-xlarge uk-margin-auto uk-text-left@m uk-text-center" uk-scrollspy-class>{!! $settings['essential-title'] !!}</h2>
                                <div class="uk-panel uk-margin uk-width-xlarge@m uk-margin-auto@m uk-margin-auto uk-text-left@m uk-text-center" uk-scrollspy-class>
                                    {!! $settings['essential-description'] !!}
                                </div>
                                <div class="uk-margin-medium uk-width-xlarge uk-margin-auto uk-text-left@m uk-text-center" uk-scrollspy-class="uk-animation-slide-bottom-small">
                                    <a class="el-content uk-button uk-button-primary" title="Contact Us" href="{!! $settings['essential-link'] !!}">
                                        {!! $settings['essential-link-title'] !!}
                                    </a>
                                </div>
                            @endif
                        </div>
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