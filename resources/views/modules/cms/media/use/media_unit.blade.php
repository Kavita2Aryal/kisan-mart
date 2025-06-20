<div class="media-masonry-item media-parent">
    <div class="media-image">
        <a href="{{ secure_img($filename, '1200') }}" target="_blank">
            <img src="{{ secure_img($filename, '480X320') }}" class="full-width">
        </a>
    </div>
    <div class="media-options">
        <div class="pull-right">
            @if ($type == 'multiple')
            <a href="javascript:void(0);" class="normal btn btn-link multi-opt">
                <div class="form-check info m-t-0 m-b-0">
                    <input type="checkbox" class="item-use-media" id="use-{{ $id }}">
                    <label for="use-{{ $id }}"><strong>USE</strong></label>
                </div>
            </a>
            @else
            <button class="btn btn-link single-use-media single-opt">
                <i class="pg-icon m-r-5">pin_alt</i><strong>USE</strong>
            </button>
            @endif
            <input type="hidden" class="image-index" value="{{ $id }}">
            <input type="hidden" class="image-image" value="{{ $filename }}">
            <input type="hidden" class="image-min" value="{{ secure_img($filename, '480X320') }}">
            <input type="hidden" class="image-max" value="{{ secure_img($filename, '1200') }}">
        </div>
        <div class="clearfix"></div>
    </div>
</div>