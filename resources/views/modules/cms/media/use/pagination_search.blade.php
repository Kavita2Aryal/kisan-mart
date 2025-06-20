<div class="row">
    <div class="col-sm-12">
        <div class="form-group form-group-default input-group m-b-0">
            <div class="form-input-group">
                <label>Search <span class="visible-x-inline">Image</span></label>
                <input type="text" name="search" value="{{ request()->search }}" class="form-control search-use-media" placeholder="eg: 'mountain, river'">
            </div>
            <div class="input-group-append">
                <span class="input-group-text">
                    <button type="button" class="btn btn-link btn-lg btn-search-use-media">
                        <i class="pg-icon">search</i>
                    </button>
                </span>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">
                    <button type="button" class="btn btn-link btn-lg btn-refresh-use-media">
                        <i class="pg-icon">refresh_alt</i>
                    </button>
                </span>
            </div>
            <div class="input-group-append multi-opt">
                <span class="input-group-text">
                    <button type="button" class="btn btn-link btn-lg multiple-use-media">
                        <strong class="p-l-5 p-r-5">USE SELECTED</strong>
                        <i class="pg-icon">tick</i>
                    </button>
                </span>
            </div>
            <div class="input-group-append multi-opt">
                <span class="input-group-text">
                    <button type="button" class="btn btn-link btn-lg clear-multiple-use-media">
                        <strong class="p-l-5 p-r-5">CLEAR SELECTED</strong>
                        <i class="pg-icon">close_lg</i>
                    </button>
                </span>
            </div>
        </div>
    </div>
</div>