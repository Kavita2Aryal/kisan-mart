@if ($images->count() > 0)
    <div class="row">
        <div class="col-sm-12">
            <div class="use-media-container scroll-ing">
                <div class="media-masonry">
                    @foreach ($images as $row)
                        @if (Storage::exists('public/media/' . $row->image))
                        <div class="media-masonry-item media-parent">
                            <div class="media-image">
                                <a href="{{ secure_img($row->image, '1200') }}" target="_blank">
                                    <img src="{{ secure_img($row->image, '480X320') }}" class="full-width">
                                </a>
                            </div>
                            <div class="media-options">
                                <div class="pull-right">
                                    @if ($type == 'multiple')
                                    <a href="javascript:void(0);" class="normal btn btn-link multi-opt">
                                        <div class="form-check info m-t-0 m-b-0">
                                            <input type="checkbox" class="item-use-media" id="use-{{ $row->id }}">
                                            <label for="use-{{ $row->id }}"><strong>USE</strong></label>
                                        </div>
                                    </a>
                                    @else
                                    <button class="btn btn-link single-use-media single-opt">
                                        <i class="pg-icon m-r-5">pin_alt</i><strong>USE</strong>
                                    </button>
                                    @endif
                                    <input type="hidden" class="image-index" value="{{ $row->id }}">
                                    <input type="hidden" class="image-image" value="{{ $row->image }}">
                                    <input type="hidden" class="image-min" value="{{ secure_img($row->image, '480X320') }}">
                                    <input type="hidden" class="image-max" value="{{ secure_img($row->image, '1200') }}">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @if ($images->hasPages())
    <div class="row m-t-10">
        <div class="col-sm-12 col-xlg-12 col-lg-12 col-md-12">
            <div class="default-pagination scroll-pagination scroll-ing paging-use-media m-b-0">
                {{ $images->appends($_GET)->render() }}
            </div>
        </div>
    </div>
    @endif
@else
    <div class="row">
        <div class="col-sm-12">
            <h5>Image not found!</h5>
        </div>
    </div>
@endif