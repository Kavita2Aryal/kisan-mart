<div class="modal fade slide-up disable-scroll modal-page-layout-save" data-backdrop="static">
    <div class="modal-dialog" style="width: 600px !important;">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{ route('page.layout.config.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="m-t-20">Save Page Layout</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-default">
                                            <label>Page Layout Name</label>
                                            <input type="text" required name="name" class="form-control page-layout-name" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="page-layout-section-config"></div>
                        <div class="row">
                            <div class="col-md-12 m-t-5">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-save-layout-2">
                                        SAVE PAGE LAYOUT
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