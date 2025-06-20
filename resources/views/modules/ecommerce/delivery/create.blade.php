@extends('layouts.app')

@section('title', 'Create Delivery')

@section('content')
    <div class="container-fluid">
        <form class="m-t-20" role="form" method="POST" action="{{ route('delivery.store') }}">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-8 col-xlg-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title full-width">Create Delivery
                                <a href="{{ route('delivery.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group form-group-default required @error('name') has-error @enderror">
                                <label>Name</label>
                                <div class="controls">
                                    <input type="text" class="form-control @error('name') error @enderror" name="name" autocomplete="off" value="{{ old('name') }}">
                                    @error('name')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group form-group-default form-group-default-select2 required @error('day') has-error @enderror">
                                <label>Day</label>
                                <select class="full-width @error('day') error @enderror" name="day" data-placeholder="Select a Day" data-init-plugin="select2" required>
                                    <option value="" data-prefix="">Select a Day</option>
                                    <option value="Sunday"> Sunday </option>
                                    <option value="Monday"> Monday </option>
                                    <option value="Tuesday"> Tuesday </option>
                                    <option value="Wednesday"> Wednesday </option>
                                    <option value="Thursday"> Thursday </option>
                                    <option value="Friday"> Friday </option>
                                    <option value="Saturday"> Saturday </option>

                                </select>
                                @error('day')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>


                            <div class="form-group form-group-default form-group-default-select2 required @error('area_id') has-error @enderror">
                                <label>Area</label>
                                <select class="full-width @error('area_id') error @enderror" name="area_id[]" data-placeholder="Select a Area" data-init-plugin="select2" multiple required>
                                    <option value="" data-prefix="">Select a Area</option>
                                    @forelse ($areas as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('area_id')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>

                            <div class="form-group form-group-default required @error('name') has-error @enderror">
                                <label>Minimum Order Amount</label>
                                <div class="controls">
                                    <input name="minimum_order_amount" placeholder="{{ "NPR" }}" type="text" required class="form-control not-variant-selling-price custom-decimal-field @error('minimum_order_amount') error @enderror product-price" autocomplete="off" value="{{ old('minimum_order_amount') }}">
                                    @error('minimum_order_amount')
                                    <label class="error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group  col-12">
                                <strong class="m-r-10">Delivery Type:</strong>

                                        <div class="form-check form-check-inline complete">
                                            <input type="radio" name="delivery_type" id="delivery-type-free-delivery" value="1" checked>
                                            <label for="delivery-type-free-delivery"> Free Delivery</label>
                                        </div>

                                <div class="form-check form-check-inline complete">
                                    <input type="radio" name="delivery_type" id="delivery-type-discount-on-delivery" value="2">
                                    <label for="delivery-type-discount-on-delivery"> Discount On Delivery</label>
                                </div>

                            </div>

                            <div class="delivery-discount" style="display: none">
                                <div class="form-group  col-12">
                                    <strong class="m-r-10">Discount Type:</strong>
                                    @if ($discount_types != null)
                                        @foreach ($discount_types as $key => $type)
                                            <div class="form-check form-check-inline complete">
                                                <input type="radio" name="discount_type" id="discount-type-{{ $key }}" value="{{ $key }}" @if ($key == 1) checked @endif>
                                                <label for="discount-type-{{ $key }}">{{ $type }}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="form-group form-group-default @error('discount_value') has-error @enderror">
                                    <label>Discount Value</label>
                                    <div class="controls">
                                        <input type="text" class="form-control custom-decimal-field @error('discount_value') error @enderror" name="discount_value" autocomplete="off" value="{{ old('discount_value') }}">
                                        @error('discount_value')
                                        <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-check info m-t-0 m-b-0">
                                        <input type="checkbox" name="is_active" value="10" id="checkbox-active" checked>
                                        <label for="checkbox-active">Publish ?</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                        CREATE <span class="visible-x-inline m-l-5">DELIVERY</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@push('styles')
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('[data-init-plugin=select2]').select2({});

            $('input[name="delivery_type"]').click(function(){
                var inputValue = $(this).attr("value");
                if(inputValue == 1)
                {
                    $(".delivery-discount").hide();
                }else {
                    $(".delivery-discount").show();
                }
            });
        });
    </script>
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
@endpush
