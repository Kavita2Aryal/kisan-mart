@extends('layouts.app')

@section('title', 'Manage Offer')

@section('content')

<div class="container-fluid m-t-20">
	<div class="card m-b-10">
		<div class="card-header">
			<div class="card-title full-width">Offer Management - <span class="text-success"> ({{$offer->name}}) </span>
				<a href="{{ route('offer.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
			</div>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete" id="open-product-listing">ADD PRODUCTS</button>
			@if ($offer->products->count() > 0)
			<button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-info check-all-products">SELECT ALL</button>
			<button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-danger remove-selected-product">REMOVE SELECTED</button>
			<button type="submit" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success update-discount">UPDATE DISCOUNT</button>
			@endif
		</div>
	</div>
	@if ($offer->products->count() > 0)
	<div class="card">
		<div class="card-body">
			<table class="table table-hover table-responsive-block table-condensed dataTable no-footer offer-table" id="tableWithSearch">
				<thead>
					<tr role="row">
						<th class="sorting" width="25">#</th>
						<th class="sorting_asc">Product</th>
						<th class="sorting">Category</th>
						<th class="sorting" width="150">Brand</th>
						<th class="sorting">Offer Discount</th>
					</tr>
				</thead>
				<tbody>
					@php $i=0; @endphp
					@foreach ($offer->products as $product)
					<tr role="row">
						<td class="v-align-middle">
							{{ ++$i }}
						</td>
						<td class="v-align-middle">
							<div class="form-check info m-b-0">
								<input type="checkbox" name="selected_product" id="product-removed-{{ $product->uuid }}" value="{{ $product->id }}">
								<label for="product-removed-{{ $product->uuid }}" title="{{ $product->name }}">{{ $product->name }}</label>
							</div>
						</td>
						<td class="v-align-middle">
							@php $category_name = ''; @endphp
							@if($product->product_categories != null)
								@foreach($product->product_categories as $row)
									@php $category_name .= $row->category->name . ' | '; @endphp
								@endforeach
							@endif
							<span title="{{ $category_name }}">{{ $category_name }}</span>
						</td>
						<td class="v-align-middle">
							<span title="{{ $product->brand->name }}">{{ $product->brand->name }}</span>
						</td>
						<td class="v-align-middle">
							@if ($product->offer->discount_type == 1)
							<div class="form-group input-group m-b-0">
								<input type="text" class="form-control custom-decimal-field offer-discount" name="discount[]" data-product="{{ $product->id }}" value="{{ $product->offer->discount }}" placeholder="Discount">
								<div class="input-group-append">
									<span class="input-group-text">%</span>
								</div>
							</div>
							@elseif ($product->offer->discount_type == 2)
							<div class="form-group input-group m-b-0">
								<div class="input-group-append">
									<span class="input-group-text">NPR</span>
								</div>
								<input type="text" class="form-control custom-decimal-field offer-discount" name="discount[]" data-product="{{ $product->id }}" value="{{ $product->offer->discount }}" placeholder="Discount">
							</div>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif
</div>

@include('modules.ecommerce.includes.modal-product-listing-offer', [
'categories' => $categories,
'brands' => $brands,
'discount_type' => $offer->discount_type,
'route' => route('offer.manage.save', [$offer->uuid])
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
	var remove_selected_product = "{{ route('offer.remove.products', [$offer->uuid]) }}";
	var discount_update = "{{ route('offer.discount.update', [$offer->uuid]) }}";
</script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/product-manage-v1.min.js') }}" type="text/javascript"></script>
@endpush