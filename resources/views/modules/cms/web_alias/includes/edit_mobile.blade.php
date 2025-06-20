<div class="modal fade slide-up p-0 alias-modal">
    <div class="modal-dialog">
        <div class="modal-content-wrapper">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row alias-edit" data-type="mobile">
                        <div class="col-lg-12">
                            <h4>Update Web Alias</h4> 
                            <div class="form-group">
                                <input type="text" class="form-control" readonly value="{{ config('app.addons_config.domain') }}">
                                <textarea class="form-control alias-value alias-check">{{ $request->alias }}</textarea>
                                <input type="hidden" class="alias-index" value="{{ $request->id }}">
                            </div>
                        </div>
                        <div class="col-lg-12 text-right">
                            <button type="submit" class="btn btn-outline-info btn-lg btn-update"><i class="pg-icon m-r-5">save</i> Update</button>
                            <button type="button" class="btn btn-outline-info btn-lg" data-dismiss="modal"><i class="pg-icon m-r-5">close_lg</i> Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>