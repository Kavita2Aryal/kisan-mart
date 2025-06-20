@extends('layouts.app')

@section('title', 'Manage PromoCode')

@section('content')

<div class="container-fluid m-t-20">
	<div class="card m-b-10">
		<div class="card-header">
			<div class="card-title full-width">PromoCode Management - <span class="text-success"> ({{$promocode->code}}) </span> - {{ $promocode->type == 2 ? 'Include Product' : 'Exclude Product' }}
				<a href="{{ route('promocode.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
			</div>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete" id="open-product-listing">ADD PRODUCTS</button>
			@if ($promocode->products->count() > 0)
			<button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-info check-all-products">SELECT ALL</button>
			<button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-danger remove-selected-product">REMOVE SELECTED</button>
			@endif
		</div>
	</div>
	@if ($promocode->products->count() > 0)
	<div class="card">
		<div class="card-body">
			<table class="table table-hover table-condensed table-responsive-block dataTable no-footer" id="tableWithSearch">
				<thead>
					<tr role="row">
						<th class="sorting_asc">Product</th>
						<th class="sorting">Category</th>
						<th class="sorting">Brand</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($promocode->products as $product)
					<tr role="row">
						<td class="v-align-middle">
							<div class="form-check info m-b-0">
								<input type="checkbox" name="selected_product" id="product-removed-{{ $product->uuid }}" value="{{ $product->id }}">
								<label for="product-removed-{{ $product->uuid }}">{{ $product->name }}</label>
							</div>
						</td>
						<td class="v-align-middle">
							@if($product->product_categories != null)
								@foreach($product->product_categories as $row)
									{{ $row->category->name }} |
								@endforeach
							@endif
						</td>
						<td class="v-align-middle">
							{{ $product->brand->name }}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	@endif
</div>

@include('modules.ecommerce.includes.modal-product-listing', [
'categories' => $categories,
'brands' => $brands,
'route' => route('promocode.manage.save', [$promocode->uuid])
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
	var remove_selected_product = "{{ route('promocode.remove.products', [$promocode->uuid]) }}";
</script>
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/product-manage.min.js') }}" type="text/javascript"></script>
@endpush