@php $index = indexing(); @endphp
<div class="row item-content" id="{{ $index }}">
    <div class="col-md-12 b-b b-grey m-b-15 p-b-5">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group-default input-group required">
                    <div class="form-input-group">
                        <label><strong class="sn-index"></strong> Value</label>
                        <input type="text" class="form-control" required="" name="items[{{ $index }}][value]" value="{{ $item->value ?? '' }}">
                    </div>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-link text-danger btn-remove-item">
                            <i class="pg-icon m-r-10 m-l-10">close_lg</i>
                        </button>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>