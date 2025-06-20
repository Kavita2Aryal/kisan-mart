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
									<option value="">Select Category</option>
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
							<div class="form-group form-group-default">
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
								<button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success save-selected-product-offer" style="display: none;">SAVE SELECTED PRODUCTS</button>
							</div>
						</div>
					</div>
					<form id="manage-products-offer-save-form" action="{{ $route }}" method="POST">
						@csrf
						@method('PUT')
						<div id="selected-product-listing"></div>
						<hr class="m-b-10 m-t-10">
						<div class="row">
							<div class="col-sm-12 col-lg-8"></div>
							<div class="col-sm-12 col-lg-4">
								@if ($discount_type == 1)
								<div class="form-group input-group discount-entry">
									<div class="input-group-prepend">
										<span class="input-group-text">DISCOUNT</span>
									</div>
									<input type="text" class="form-control offer-discount custom-decimal-field" data-type="percent" name="discount" required min="0" max="100">
									<div class="input-group-append">
										<span class="input-group-text">%</span>
									</div>
								</div>
								@elseif ($discount_type == 2)
								<div class="form-group input-group discount-entry">
									<div class="input-group-prepend">
										<span class="input-group-text">DISCOUNT</span>
									</div>
									<div class="input-group-prepend">
										<span class="input-group-text">NPR</span>
									</div>
									<input type="text" class="form-control offer-discount custom-decimal-field" data-type="amount" name="discount" required min="0">
								</div>
								@endif
							</div>
						</div>
						<div class="row" id="option-product-listing"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>