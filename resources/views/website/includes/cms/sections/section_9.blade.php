@if($content->is_active == 10)
<div class="uk-section-default" uk-scrollspy="target: [uk-scrollspy-class]; cls: uk-animation-slide-left-small; delay: 200;">
@if($content->image_contents->count() > 0 && $content->image_contents[0]->image != null)
    <div
        style="background-image: url('{{ secure_img($content->image_contents[0]->image->image, 'main') }}');"
        class="uk-background-norepeat uk-background-cover uk-background-top-left uk-section uk-padding-remove-vertical uk-flex uk-flex-middle"
        uk-height-viewport="offset-top: true;"
    >
@else
    <div
        class="uk-background-norepeat uk-background-cover uk-background-top-left uk-section uk-padding-remove-vertical uk-flex uk-flex-middle"
        uk-height-viewport="offset-top: true;"
    >
@endif 
        <div class="uk-width-1-1">
            <div class="uk-grid-margin uk-container">
                <div class="tm-grid-expand uk-grid-column-collapse" uk-grid>
                    <div class="uk-width-1-2@m" id="page#0-0-0"></div>

                    <div class="uk-grid-item-match uk-flex-middle uk-width-1-2@m">
                        <div class="uk-panel uk-width-1-1">
                            <div class="uk-margin-medium uk-text-center" uk-scrollspy-class>
                                <img src="{{ url('storage/website/logo.svg') }}" width="260" class="el-image" alt />
                            </div>
                            <div class="uk-panel uk-text-large uk-margin uk-width-xlarge uk-margin-auto uk-text-center" uk-scrollspy-class>
                                @foreach($content->descriptions as $description)
                                    {!! $description->description !!}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif