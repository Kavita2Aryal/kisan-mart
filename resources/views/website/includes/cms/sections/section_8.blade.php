@if($content->is_active == 10)
<div class="uk-section-default" uk-scrollspy="target: [uk-scrollspy-class]; cls: uk-animation-slide-bottom-medium; delay: 200;">
@if($content->image_contents->count() > 0 && $content->image_contents[0]->image != null)
    <div style="background-image: url('{{ secure_img($content->image_contents[0]->image->image, 'main') }}');" class="uk-background-norepeat uk-background-cover uk-background-center-center uk-section uk-section-large">
@else
    <div class="uk-background-norepeat uk-background-cover uk-background-center-center uk-section uk-section-large">
@endif        
        <div class="uk-container uk-container-expand">
            <div class="uk-visible@m tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
                <div class="uk-grid-item-match uk-visible@m">
                    <div class="uk-panel uk-width-1-1">
                        <div id="page#9-0-0-0" class="uk-visible@m uk-position-absolute uk-width-1-1 uk-text-right" style="right: 120px; bottom: 40px;" uk-scrollspy-class>
                            <img src="{{ url('storage/website/cta-shape-01.svg') }}" width="170" height="170" class="el-image" alt target="!*" />
                        </div>

                        <div id="page#9-0-0-1" class="uk-visible@m uk-position-absolute uk-width-1-1 uk-text-right" uk-scrollspy-class>
                            <img src="{{ url('storage/website/cta-shape-02.svg') }}" width="120" height="120" class="el-image" alt target="!*" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="uk-grid-margin uk-container uk-container-large">
                <div class="tm-grid-expand" uk-grid>
                    <div class="uk-width-1-2@m">
                        <h2 class="uk-heading-small uk-text-secondary uk-position-relative uk-text-left@s uk-text-center" style="z-index: 1;" uk-scrollspy-class>
                            @foreach($content->descriptions as $description)
                                    {!! $description->description !!}
                            @endforeach
                        </h2>
                        @if($content->list_links != null)
                        @foreach($content->list_links as $link)
                            <div class="uk-position-relative uk-margin-medium uk-text-left@s uk-text-center" style="z-index: 1;" uk-scrollspy-class>
                                <a class="el-content uk-button uk-button-primary" href="{!! $link->value !!}">
                                    {!! $link->title !!}
                                </a>
                            </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="uk-width-1-2@m"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif