@if($content->is_active == 10)
    @isset($lists)
        @php $lists_content = (array) $lists; @endphp
        @if(isset($lists_content[0]) && $lists_content[0]['list_content_body'] != null)
            <div class="uk-section-default uk-section uk-section-small uk-padding-remove-top">
                <div class="uk-container uk-container-small">
                    <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
                        @foreach($lists_content[0]['list_content_body'] as $body)
                            @if(isset($body->image_contents[0]) && $body->image_contents[0]->image != null && $body->image_contents[0]->image->image != null)
                                @php $image = $body->image_contents[0]->image->image; @endphp
                                <div>
                                    <div class="uk-margin uk-text-center">
                                        <a class="el-link" href="{{ $body->link }}">
                                            <img
                                                src="{{ secure_img($image, 'main') }}"
                                                sizes="(min-width: 1600px) 1600px"
                                                data-width="1600"
                                                data-height="250"
                                                class="el-image uk-border-rounded uk-box-shadow-medium uk-box-shadow-hover-large lozad"
                                                alt
                                            />
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endisset
@endif