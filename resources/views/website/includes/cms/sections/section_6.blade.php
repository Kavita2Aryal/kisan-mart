@if($content->is_active == 10)
    @isset($lists)
        @php $lists_content = (array) $lists; @endphp
        @if(isset($lists_content[0]) && $lists_content[0]['list_content_body'] != null)
            <div id="page#6" class="uk-section-muted uk-section" uk-scrollspy="target: [uk-scrollspy-class]; cls: uk-animation-slide-bottom-medium; delay: 200;">
                <div class="uk-container">
                    @foreach($lists_content[0]['list_content_body']->chunk(2) as $chunk)
                        <div class="tm-grid-expand uk-grid-medium uk-margin-medium" uk-grid>
                            @foreach($chunk as $body)
                                @if(isset($body->image_contents[0]) && $body->image_contents[0]->image != null && $body->image_contents[0]->image->image != null)
                                    @php $image = $body->image_contents[0]->image->image; @endphp
                                    <div class="uk-width-1-2@m">
                                        <div class="uk-light gallery-hover-image uk-margin uk-text-center" uk-scrollspy-class>
                                            <a class="el-container" href="{{ $body->link }}">
                                                <img
                                                    src="{{ secure_img($image, 'main') }}"
                                                    sizes="(min-width: 1440px) 1440px"
                                                    data-width="1440"
                                                    data-height="1226"
                                                    alt
                                                    class="el-image uk-transition-scale-up uk-transition-opaque lozad"
                                                />

                                                <div class="uk-tile-primary el-overlay uk-position-cover"></div>
                                                <div class="uk-position-bottom-center">
                                                    <div class="uk-overlay uk-padding-small uk-margin-remove-first-child">
                                                        <div class="el-meta uk-h5 uk-margin-top uk-margin-remove-bottom">{!! $body->title !!}</div>
                                                        <h3 class="el-title uk-h2 uk-margin-remove-top uk-margin-remove-bottom">{!! $body->subtitle !!}</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endisset
@endif