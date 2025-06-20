<tr class="alias-edit" data-type="desktop" style="display: none;">
    <td colspan="6">
        <div class="form-group form-group-default input-group m-b-0">
            <div class="input-group-append">
                <span class="input-group-text"><i class="pg-icon m-r-5">globe</i> {{ config('app.addons_config.domain') }}</span>
            </div>
            <div class="form-input-group">
                <input type="text" class="form-control alias-value alias-check" value="{{ $request->alias }}">
                <input type="hidden" class="alias-index" value="{{ $request->id }}">
            </div>
            <div class="input-group-append">
                <span class="input-group-text">
                    <button type="button" class="normal btn btn-link p-l-10 p-r-10 btn-lg btn-update">SAVE</button>
                </span>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">
                    <button type="button" class="normal btn btn-link p-l-10 p-r-10 btn-lg text-danger btn-cancel"><i class="pg-icon">close_lg</i> CLOSE</button>
                </span>
            </div>
        </div>
    </td>
</tr>