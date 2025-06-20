@php
$min_width = config('app.config.image_min_width');
$min_height = config('app.config.image_min_height');
@endphp
<div class="modal fade modal-use-media {{ $type }}" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-transparent m-b-0">
                            <ul class="nav nav-tabs nav-tabs-fillup">
                                <li class="nav-item">
                                    <a href="#" data-toggle="tab" data-target="#select-image-{{ $type }}" class="active">
                                        <span>Select <strong class="visible-x-inline">Image</strong></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" data-toggle="tab" data-target="#upload-image-{{ $type }}">
                                        <span>Upload <strong class="visible-x-inline">Image</strong></span>
                                    </a>
                                </li>
                                <li class="nav-item close-use-media">
                                    <a href="#" class="nav-tabs-danger" data-dismiss="modal">
                                        <span>Close</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane slide-left active" id="select-image-{{ $type }}">
                                    @include('modules.cms.media.use.pagination_search', ['type' => $type])
                                    <div class="use-media-parent">
                                        @include('modules.cms.media.use.media_grid', ['images' => $images, 'type' => $type])
                                    </div>
                                </div>
                                <div class="tab-pane slide-left" id="upload-image-{{ $type }}">
                                    <div class="upload-media-container scroll-ing">
                                        <div class="card" style="border-top: 1px solid #eee;">
                                            <div class="card-header">
                                                <div class="card-title full-width">
                                                    <strong>Upload <strong class="visible-x-inline">Image</span></strong>
                                                        <button type="button" class="btn btn-link pull-right multi-opt clear-multiple-use-media p-l-10 p-r-10">
                                                            <strong>CLEAR SELECTED</strong>
                                                            <i class="pg-icon">close_lg</i>
                                                        </button>
                                                        <button type="button" class="btn btn-link pull-right multi-opt multiple-use-media p-l-10 p-r-10">
                                                            <strong>USE SELECTED</strong>
                                                            <i class="pg-icon">tick</i>
                                                        </button>
                                                </div>
                                            </div>
                                            <div class="card-body no-scroll no-padding">
                                                <form action="#" class="dropzone dropzone-media-modal-{{ $type }} no-margin" method="post" enctype="multipart/form-data">
                                                    <div class="fallback">
                                                        <input name="image" type="file" accept="image/*">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="card-header">
                                                <div class="card-title full-width">
                                                    Minimum Resolution: {{ $min_width }}px X {{ $min_height }}px
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media-masonry"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>