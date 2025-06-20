@if($content->is_active == 10)
<div class="uk-section-muted uk-section uk-section-xsmall">
    <div class="uk-container">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin uk-grid uk-grid-stack" uk-grid="">
            <div class="uk-first-column">
                <div class="uk-h1 uk-text-secondary uk-position-relative uk-text-center">{!! $content->title !!}</div>
            </div>
        </div>
    </div>
</div>
@endif
