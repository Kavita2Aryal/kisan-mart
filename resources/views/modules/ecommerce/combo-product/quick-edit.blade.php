<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form class="form-quick-edit" method="POST" action="{{ route('product.quick.update', [$uuid]) }}">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Update Price/Qty</h5>
                <h6>{{ $product_name }}</h6>
                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            @php $currency = 'NPR'; @endphp
            <div class="modal-body offer-content-body">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            @if($has_variant == 10)<th style="width:100px">Variation <strong class="text-danger">*</strong></th>@endif
                            <th style="width:100px">SKU <strong class="text-danger">*</strong></th>
                            <th style="width:100px">Avalilable QTY <strong class="text-danger">*</strong></th>
                            <th style="width:100px">Selling Price <strong class="text-danger">*</strong></th>
                            <th style="width:100px; display:none;">Compare Price</th>
                            <th style="width:100px">Cost Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <input type="hidden" name="product_id" value="{{ $id }}" >
                        @php $i = 0; @endphp
                        @foreach($variation as $row)
                            <tr>
                                <input type="hidden" name="variation[{{$i}}][id]" value="{{ $row->id }}">
                                @if($has_variant == 10)
                                <td class="v-align-middle p-l-5 p-r-5">
                                    <label for="variant" >{{ $row->variant }}</label>
                                </td>
                                @endif
                                <td class="v-align-middle p-l-5 p-r-5">
                                    <input name="variation[{{$i}}][sku]" readonly placeholder="SKU" type="text" class="form-control" autocomplete="off" value="{{ $row->sku }}" style="color:black;">
                                </td>
                                <td class="v-align-middle p-l-5 p-r-5">
                                    <input name="variation[{{$i}}][qty]" placeholder="QTY" type="number" min="0" max="9999999999" class="form-control" autocomplete="off" value="{{ $row->qty }}">
                                    
                                </td>
                                <td class="v-align-middle p-l-5 p-r-5">
                                    <input name="variation[{{$i}}][selling_price]" placeholder="{{ $currency }}" type="text" required class="form-control custom-decimal-field product-price" autocomplete="off" value="{{ $row->selling_price }}">
                                    
                                </td>
                                <td class="v-align-middle p-l-5 p-r-5" style="display:none;>
                                    <input name="variation[{{$i}}][compare_price]" placeholder="{{ $currency }}" type="text" class="form-control custom-decimal-field product-cmp-price" autocomplete="off" value="{{ $row->compare_price }}">
                                    
                                </td>
                                <td class="v-align-middle p-l-5 p-r-5">
                                    <input name="variation[{{$i}}][cost_price]" placeholder="{{ $currency }}" type="text" class="form-control custom-decimal-field product-cost-price" autocomplete="off" value="{{ $row->cost_price }}">
                                    
                                </td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-danger m-b-5" data-dismiss="modal">CLOSE</button>
                <button type="submit" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success m-b-5">UPDATE</button>
            </div>
        </form>
    </div>
</div>