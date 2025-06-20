@extends('layouts.app')

@section('title', 'Create Order')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" role="form" method="POST" action="{{ route('order.create') }}">
        @csrf
		<div class="row">
			<div class="card">
				<div class="card-header">
					<div class="card-title full-width">Select Products
						<a href="{{ route('order.pending') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
					</div>
				</div>
				<div class="card-body">
					<button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete" id="open-product-listing">ADD PRODUCTS</button>
					@if (count($data) > 0)
					<button type="submit" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success pull-right">SAVE ITEMS</button>
					<button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-info check-all-products">SELECT ALL</button>
					<button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-danger order-remove-selected-product">REMOVE SELECTED</button>
					@endif
				</div>
			</div>
			@if (count($data) > 0)
				<div class="card">
					<div class="card-body">
						<table class="table table-hover table-responsive-block table-condensed dataTable no-footer order-selected-items-table" id="tableWithSearch">
							<thead>
								<tr role="row">
									<!-- <th class="sorting" width="25">#</th> -->
									<th class="sorting_asc">Product</th>
									<th class="sorting">Brand</th>
									<th class="sorting">Variant</th>
									<th class="sorting">Actual Price</th>
									<th class="sorting">Offer Price</th>
									<th class="sorting">Quantity</th>
									<!-- <th class="sorting"></th> -->
								</tr>
							</thead>
							<tbody>
								@php $i=0; @endphp
								@foreach ($data as $row)
								<tr role="row" class="tr-{{ $row['id'] }}">
									<!-- <td class="v-align-middle">
										{{ ++$i }}
									</td> -->
									<td class="v-align-middle">
										<div class="form-check info m-b-0">
											<input type="checkbox" name="selected_product" id="product-removed-{{ $row['id'] }}" value="{{ $row['id'] }}">
											<label for="product-removed-{{ $row['id'] }}" class="text-wrap">{{ucwords($row['product_name']) }}</label>
										</div>
									</td>
									<td class="v-align-middle">
										{{ ucwords($row['brand']) }}
									</td>
									<td class="v-align-middle">
										@if($row['has_variant'] == 10)
										<select name="products[{{ $i }}][sku]" class="selected_product_variant" id="variant-{{ $row['id'] }}">
											@foreach($row['variant'] as $r_variant)
												<option value="{{ $r_variant['sku'] }}" data-product="{{ $row['id'] }}" data-actual-price="{{ $r_variant['actual_price'] }}" data-price="{{ $r_variant['price'] }}" @if($r_variant['sku'] == $row['sku']) selected @endif>{{ ($r_variant['variant']) }}</option>
											@endforeach
										</select>
										@else
											-
											<input type="hidden" name="products[{{ $i }}][sku]" id="variant-{{ $row['id'] }}" value="{{ $row['sku'] }}">
										@endif
										<input type="hidden" class="selected_product_actual_price" id="actual-price-{{ $row['id'] }}" name="products[{{ $i }}][actual_price]" value="{{ $row['actual_price'] }}">
										<input type="hidden" class="selected_product_price" id="price-{{ $row['id'] }}" name="products[{{ $i }}][price]" value="{{ $row['price'] }}">
										<input type="hidden" name="products[{{ $i }}][product_id]" value="{{ $row['product_id'] }}">
									</td>
									<td class="v-align-middle td-actual-price-{{ $row['id'] }}">
										{{ 'NPR '. number_format($row['actual_price'], 2) }}
									</td>
									<td class="v-align-middle td-price-{{ $row['id'] }}">
										{{ 'NPR '. number_format($row['price'], 2) }}
									</td>
									<td class="v-align-middle">
										<input name="products[{{ $i }}][qty]" id="qty-{{ $row['id'] }}" data-product="{{ $row['id'] }}" placeholder="QTY" type="number" min="1" max="9999999999" class="form-control" autocomplete="off" value="{{ $row['qty'] }}">
									</td>
									<!-- <td class="v-align-middle">
										<button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-warning update-selected-product" data-product="{{ $row['id'] }}"><i class="pg-icon m-r-5">pencil</i> UPDATE</button>
									</td> -->
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			@endif
		</div>
	</form>
</div>
@include('modules.ecommerce.order.includes.product-listing-modal', [
        'categories' => $categories,
        'brands' => $brands,
        'route' => route('order.save.selected.items')
    ])
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables-responsive/css/datatables.responsive.css') }}" rel="stylesheet" type="text/css" media="screen" />
@endpush

@push('scripts')
<script>
	var get_filter_products = "{{ route('product.search') }}";
	var remove_selected_product = "{{ route('order.remove.selected.items') }}";
	var update_selected_product = "{{ route('order.update.selected.items') }}";
	$(document).on('change', '.selected_product_variant', function() {
		var $this = $(this).find(':selected');
		var index = $this.data('product');
		var actual_price = parseFloat($this.data('actual-price'));
		var price = parseFloat($this.data('price'));
		$('#actual-price-'+index).val(actual_price)
		$('#price-'+index).val(price)
		$('.td-actual-price-'+index).text('NPR ' +money_format(actual_price, 2))
		$('.td-price-'+index).text('NPR ' +money_format(price, 2))
	})
</script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/product-manage.min.js') }}" type="text/javascript"></script>
@endpush