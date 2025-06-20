@extends('layouts.app')

@section('title', 'Add Order Items')

@section('content')

<form action="{{ route('order.save.items', [$order->uuid]) }}" method="POST">
	@csrf
	<div class="container-fluid m-t-20">
		<div class="card m-b-10">
			<div class="card-header">
				<div class="card-title full-width">Order Product Management - <span class="text-success"> ({{$order->order_code}}) </span>
					<a href="{{ route('order.detail', [$order->uuid]) }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
				</div>
			</div>
			<div class="card-body">
				<button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete" id="open-product-listing">ADD PRODUCTS</button>
				@if (count($data) > 0)
				<button type="submit" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success">SAVE ITEMS</button>
				@endif
			</div>
		</div>
		@if (count($data) > 0)
		<div class="card">
			<div class="card-body">
				<table class="table table-hover table-responsive-block table-condensed dataTable no-footer offer-table" id="tableWithSearch">
					<thead>
						<tr role="row">
							<th class="sorting" width="25">#</th>
							<th class="sorting_asc">Product</th>
							<th class="sorting">Category</th>
							<th class="sorting">Brand</th>
							<th class="sorting">Variant</th>
							<th class="sorting">Quantity</th>
						</tr>
					</thead>
					<tbody>
						@php $i=0; @endphp
						@foreach ($data as $row)
						<tr role="row">
							<td class="v-align-middle">
								{{ ++$i }}
							</td>
							<td class="v-align-middle">
								{{ ucwords($row['name']) }}
							</td>
							<td class="v-align-middle">
								@if($row['categories'] != null)
									@foreach($row['categories'] as $cat)
										{{ ucwords($cat) }} |
									@endforeach
								@endif
							</td>
							<td class="v-align-middle">
								{{ ucwords($row['brand']) }}
							</td>
							<td class="v-align-middle">
								@if($row['has_variant'] == 10)
								<select name="products[{{ $row['id'] }}][sku]" class="selected_product_variant" id="variant-{{ $row['id'] }}">
									@foreach($row['variant'] as $r_variant)
										<option value="{{ $r_variant['sku'] }}" data-product="{{ $row['id'] }}" data-actual-price="{{ $r_variant['actual_price'] }}" data-price="{{ $r_variant['price'] }}" @if($r_variant['is_active'] == 10) selected @endif>{{ ($r_variant['variant']) }}</option>
									
									@endforeach
								</select>
								@else
									<input type="hidden" name="products[{{ $row['id'] }}][sku]" id="variant-{{ $row['id'] }}" value="{{ $row['sku'] }}">
								@endif
									<input type="hidden" class="selected_product_actual_price" id="actual-price-{{ $row['id'] }}" name="products[{{ $row['id'] }}][actual_price]" value="{{ $row['actual_price'] }}">
									<input type="hidden" class="selected_product_price" id="price-{{ $row['id'] }}" name="products[{{ $row['id'] }}][price]" value="{{ $row['price'] }}">
							</td>
							<td class="v-align-middle">
								<input name="products[{{ $row['id'] }}][qty]" placeholder="QTY" type="number" min="1" max="9999999999" class="form-control" autocomplete="off" value="1">
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@endif
	</div>
</form>

@include('modules.ecommerce.order.includes.product-listing-modal', [
        'categories' => $categories,
        'brands' => $brands,
        'route' => route('order.add.items', [$order->uuid])
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

	$(document).on('change', '.selected_product_variant', function() {
		var $this = $(this).find(':selected');
		var index = $this.data('product');
		var actual_price = parseFloat($this.data('actual-price'));
		var price = parseFloat($this.data('price'));
		$('#actual-price-'+index).val(actual_price)
		$('#price-'+index).val(price)
	})
</script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/product-manage.min.js') }}" type="text/javascript"></script>
@endpush