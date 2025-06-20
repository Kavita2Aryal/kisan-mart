@if($content->is_active == 10)
<div id="page#0" class="uk-section-default uk-light">
    @if($content->image_contents->count() > 0 && $content->image_contents[0]->image != null)
        <div
            data-src="{{ secure_img($content->image_contents[0]->image->image, 'main') }}"
            uk-img
            class="uk-background-norepeat uk-background-center-center uk-background-fixed uk-section uk-section-xlarge"
        >
    @else
        <div class="uk-background-norepeat uk-background-center-center uk-background-fixed uk-section uk-section-xlarge"
            >
    @endif
            <div class="uk-container">
                <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
                    <div class="uk-width-1-1@m"></div>
                </div>
            </div>
        </div>
</div>
@endif