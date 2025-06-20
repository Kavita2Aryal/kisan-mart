@if($content->is_active == 10)
<div class="uk-section-default uk-section uk-section-large uk-padding-remove-top" uk-scrollspy="target: [uk-scrollspy-class]; cls: uk-animation-slide-bottom-medium; delay: 200;">
    <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
        <div class="uk-grid-item-match">
            <div class="uk-panel uk-width-1-1">
                <div class="uk-position-absolute uk-width-1-1" style="top: -70px;" uk-scrollspy-class>
                    <img src="{{ url('storage/website/home-shape-03.svg') }}" width="540" height="800" class="el-image uk-text-muted" alt uk-svg target="!*" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="uk-section-default uk-section uk-section-large uk-padding-remove-top" uk-scrollspy="target: [uk-scrollspy-class]; cls: uk-animation-slide-bottom-medium; delay: 200;">
    <div class="uk-grid-margin uk-container uk-container-large uk-container-expand-right">
        <div class="tm-grid-expand" uk-grid>
            <div class="uk-width-1-2@m">
                <div class="uk-panel uk-margin-remove-first-child uk-position-relative uk-margin uk-text-left@m uk-text-center" style="z-index: 1;" uk-scrollspy-class>
                    <div class="el-meta uk-h6 uk-text-primary uk-margin-top uk-margin-remove-bottom">{!! $content->title !!}</div>
                    <h2 class="el-title uk-heading-small uk-text-secondary uk-margin-top uk-margin-remove-bottom">{!! $content->subtitle !!}</h2>
                    @foreach($content->descriptions as $description)
                        <div class="el-content uk-panel uk-margin-top">
                            {!! $description->description !!}
                        </div>
                    @endforeach
                    @if($content->list_links != null)
                        @foreach($content->list_links as $link)
                            <div class="uk-margin-medium-top"><a href="{!! $link->value !!}" class="el-link uk-button uk-button-primary">{!! $link->title !!}</a></div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="uk-grid-item-match uk-width-1-2@m uk-visible@m">
                <div class="uk-panel uk-width-1-1">
                    <div class="uk-visible@m uk-position-absolute uk-width-1-1 uk-text-right" style="left: 40px; bottom: 0px;" uk-scrollspy-class>
                        <img src="{{ url('storage/website/home-shape-00.svg') }}" width="510" height="355" class="el-image" alt target="!*" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif