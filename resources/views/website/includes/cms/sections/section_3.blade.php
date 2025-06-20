@if($content->is_active == 10)
<div class="uk-section-default uk-section uk-padding-remove-bottom" uk-scrollspy="target: [uk-scrollspy-class]; cls: uk-animation-slide-top-medium; delay: 200;">
    <div class="uk-margin-remove-vertical uk-container uk-container-xlarge">
        <div class="tm-grid-expand uk-child-width-1-1" uk-grid>
            @isset($lists)
                @php $lists_content = (array) $lists; @endphp
                @if(isset($lists_content[0]) && $lists_content[0]['list_content_body'] != null)
                    <div>
                        <h3 class="uk-h2 uk-text-emphasis uk-text-center" uk-scrollspy-class>Our Products</h3>
                        <div class="uk-margin uk-text-center">
                            <div class="uk-child-width-1-1 uk-child-width-1-3@s uk-child-width-1-6@m uk-grid-collapse uk-grid-match" uk-grid>
                                @php $i=0; @endphp
                                @foreach($lists_content[0]['list_content_body'] as $body)
                                    @if(isset($body->image_contents[0]) && $body->image_contents[0]->image != null && $body->image_contents[0]->image->image != null)
                                        @php $image = $body->image_contents[0]->image->image; $i++; @endphp
                                        <div>
                                            <a class="el-item uk-panel {{ ($i%2 == 0) ? 'uk-tile-muted' : 'uk-tile-default' }} uk-tile-hover uk-padding-small uk-margin-remove-first-child uk-link-toggle uk-display-block" href="{{ $body->link }}" uk-scrollspy-class>
                                                <img src="{{ secure_img($image, 'main') }}" width="96" height="96" class="el-image lozad" alt />

                                                <h3 class="el-title uk-h3 uk-margin-top uk-margin-remove-bottom">
                                                    {!! $body->title !!}
                                                </h3>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endisset
        </div>
    </div>
</div>
@endif