@if($content->is_active == 10)
<div class="uk-section-default uk-section uk-section-xsmall uk-padding-remove-top uk-padding-remove-bottom">
    <div class="uk-container uk-container-xlarge">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div>
                @if($content->slider_contents->count() > 0 && $content->slider_contents[0]->slider_items != null && $content->slider_contents[0]->slider_items->items != null)
                    <div uk-slideshow="ratio: 16:6; animation: fade; autoplay: 1; pauseOnHover: false; ; autoplayInterval: 6000;" id="slideshow-viewport-height-content-center" class="uk-margin uk-text-center">
                        <div class="uk-position-relative">
                            <ul class="uk-slideshow-items">
                                @foreach($content->slider_contents[0]->slider_items->items as $row)
                                    @isset($row->image->image)
                                        <li class="el-item">
                                            <a href="{{ $row->link }}">
                                                <img
                                                    src="{{ secure_img($row->image->image, 'main') }}"
                                                    sizes="(max-aspect-ratio: 2560/1000) 256vh"
                                                    data-width="2560"
                                                    data-height="1000"
                                                    class="el-image lozad"
                                                    alt
                                                    uk-cover
                                                />
                                            </a>
                                        </li>
                                    @endisset
                                @endforeach
                            </ul>

                            <div class="uk-position-center-right uk-position-small uk-light">
                                <ul class="el-nav uk-dotnav uk-dotnav-vertical">
                                    <li uk-slideshow-item="0">
                                        <a href="#"></a>
                                    </li>
                                    <li uk-slideshow-item="1">
                                        <a href="#"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endif