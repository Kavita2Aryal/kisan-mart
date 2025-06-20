<div class="uk-section-default uk-section">
    <div class="uk-container uk-container-xlarge">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div>
                <hr />
            </div>
        </div>
    </div>
</div>
@if($content->is_active == 10)
    @isset($lists)
        @php $lists_content = (array) $lists; @endphp
        @if(isset($lists_content[0]) && $lists_content[0]['list_content_body'] != null)
            <div class="uk-section-default uk-section uk-padding-remove-top" uk-scrollspy="target: [uk-scrollspy-class]; cls: uk-animation-scale-up; delay: 200;">
                <div class="uk-container uk-container-large">
                    <div class="tm-grid-expand uk-grid-margin" uk-grid>
                    @foreach($lists_content[0]['list_content_body'] as $body)
                        <div class="uk-width-1-3@s uk-width-1-3@m">
                            <div class="uk-margin-remove-vertical" uk-slider="sets: 1; center: 1; autoplay: 1; pauseOnHover: false;" uk-scrollspy-class>
                                <div class="uk-position-relative uk-visible-toggle" tabindex="-1">
                                    <ul class="uk-slider-items uk-grid uk-grid-match">
                                        @foreach($body->image_contents as $row)
                                            @if($row->image != null && $row->image->image != null)
                                                @php $image = $row->image->image; @endphp
                                                <li class="uk-width-1-1 uk-width-1-1@m">
                                                    <div class="el-item uk-panel uk-margin-remove-first-child">
                                                        <img
                                                            src="{{ secure_img($image, 'main') }}"
                                                            sizes="(min-width: 600px) 600px"
                                                            data-width="600"
                                                            data-height="500"
                                                            class="el-image lozad"
                                                            alt
                                                        />
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>

                                    <div class="uk-visible@m uk-hidden-hover uk-hidden-touch uk-light">
                                        <a class="el-slidenav uk-position-small uk-position-center-left" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                                        <a class="el-slidenav uk-position-small uk-position-center-right" href="#" uk-slidenav-next uk-slider-item="next"></a>
                                    </div>
                                </div>
                            </div>

                            <div class="uk-panel uk-tile-muted uk-padding uk-margin-remove-first-child uk-margin-remove-vertical" uk-scrollspy-class>
                                <h3 class="el-title uk-h3 uk-text-emphasis uk-margin-top uk-margin-remove-bottom">{!! $body->title !!}</h3>
                                <div class="el-meta uk-text-meta uk-margin-small-top">{!! $body->description !!}</div>

                                <div class="uk-margin-medium-top"><a href="{!! $body->link !!}" class="el-link uk-button uk-button-primary">{!! $body->link_title !!}</a></div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endisset
@endif