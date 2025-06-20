@if($content->is_active == 10)
<div class="uk-section-default" tm-header-transparent="dark" uk-scrollspy="target: [uk-scrollspy-class]; cls: uk-animation-slide-bottom-small; delay: false;">
    <div style="background-image: url('/storage/website/home-shape-00.svg');" class="uk-background-norepeat uk-background-bottom-right uk-section uk-padding-remove-top">
        <div class="uk-container uk-container-large">
            <div class="tm-header-placeholder uk-margin-remove-adjacent"></div>
            <div id="fonts" class="tm-grid-expand uk-child-width-1-1 uk-margin-large uk-grid uk-grid-stack" uk-grid="">
                <div class="uk-width-1-1@m uk-first-column">
                    <div class="uk-h3 uk-text-emphasis uk-scrollspy-inview" uk-scrollspy-class="" style="">{!! $content->title !!}</div>
                    @isset($lists)
                        @php $lists_content = (array) $lists; @endphp
                        @if(isset($lists_content[0]) && $lists_content[0]['list_content_body'] != null)
                            <div class="uk-margin-medium">
                                <div class="uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m uk-grid-match uk-grid" uk-grid="">
                                    @foreach($lists_content[0]['list_content_body'] as $body)
                                        @if(isset($body->image_contents[0]) && $body->image_contents[0]->image != null && $body->image_contents[0]->image->image != null)
                                            @php $image = $body->image_contents[0]->image->image; @endphp
                                            <div>
                                                <a class="el-item uk-card uk-card-default uk-card-small uk-card-hover uk-margin-remove-first-child uk-link-toggle uk-display-block uk-scrollspy-inview" href="{!! $body->link !!}" uk-scrollspy-class>
                                                    <div class="uk-card-media-top">
                                                        <img
                                                            src="{{ secure_img($image, 'main') }}"
                                                            class="el-image lozad"
                                                            alt=""
                                                        />
                                                    </div>
                                                    <div class="uk-card-body uk-margin-remove-first-child">
                                                        <h3 class="el-title uk-h5 uk-margin-top uk-margin-remove-bottom">{!! $body->title !!}</h3>
                                                        <h6 class="el-meta uk-text-meta uk-text-muted uk-margin-small-top uk-margin-remove-bottom">{!! $body->subtitle !!}</h6>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endisset
                    @if($content->list_links != null)
                        @foreach($content->list_links as $link)
                            <div class="uk-margin-xlarge uk-margin-remove-top uk-text-right@m uk-scrollspy-inview" uk-scrollspy-class="" style="">
                                <a class="el-content uk-button uk-button-primary" href="{!! $link->value !!}">
                                {!! $link->title !!}
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif