<div class="modal fade slide-right" id="product-listing">
	<div class="modal-dialog modal-lg full-width">
		<div class="modal-content-wrapper">
			<div class="modal-content">
				<div class="modal-body p-t-25">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group form-group-default form-group-default-select2">
								<label>Select Category</label>
								<select class="full-width collection-select-init" id="search-category-listing" multiple="multiple" data-placeholder="Select Category" data-init-plugin="select2" tabindex="-1" aria-hidden="true">
									@if ($categories != null)
										@foreach($categories as $row)
											@if(count($row->child) > 0)
											<optgroup label="{{ $row->name }}">
												@foreach($row->child as $child)
													<option value="{{ $child->id }}">{!! ucwords($child->name) !!}</option>
												@endforeach
											</optgroup>
											@else
												<option value="{{ $row->id }}">{!! ucwords($row->name) !!}</option>
											@endif
										@endforeach
									@endif
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group form-group-default form-group-default-select2">
								<label>Select Brand</label>
								<select class="full-width collection-select-init" id="search-brand-listing" multiple="multiple" data-placeholder="Select Brand" data-init-plugin="select2" tabindex="-1" aria-hidden="true">
									@if ($brands != null)
									<option value="">Select Brand</option>
									@foreach ($brands as $brand)
									<option value="{{ $brand->id }}">{!! ucwords($brand->name) !!}</option>
									@endforeach
									@endif
								</select>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="form-group-default">
								<label>Search Product</label>
								<input type="text" class="form-control" autocomplete="off" id="search-product-listing">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5" id="search-prod-item">SEARCH</button>
							<button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-danger" data-dismiss="modal">CLOSE</button>
						</div>
						<div class="col-sm-6">
							<div class="pull-right">
								<button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete select-all-products" style="display: none;">SELECT ALL</button>
								<button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success save-selected-product" style="display: none;"><i class="fa fa-save"></i>CONFIRM PRODUCTS</button>
							</div>
						</div>
					</div>
					<form id="manage-products-save-form" action="{{ $route }}" method="POST">
						@csrf
						<div id="selected-product-listing"></div>
						<hr class="m-b-10 m-t-10">
						<div class="row" id="option-product-listing"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>