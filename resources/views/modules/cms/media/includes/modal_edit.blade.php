<div class="modal fade slide-up disable-scroll modal-media-edit" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-body">
                    <form role="form" method="post" action="{{ route('media.update.detail') }}">
                        @csrf
                        <input type="hidden" class="image-index" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="m-t-20">Update Image Details</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>Image Title</label>
                                            <textarea name="image_title" class="form-control image-title" style="height: 40px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>Image Caption</label>
                                            <textarea name="image_caption" class="form-control image-caption" style="height: 80px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 m-t-5">
                                <div class="text-right">
                                    <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 update-image-detail">
                                        UPDATE
                                    </button>
                                    <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 text-danger" data-dismiss="modal">
                                        <i class="pg-icon m-r-5">close_lg</i> CLOSE
                                    </button> 
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>