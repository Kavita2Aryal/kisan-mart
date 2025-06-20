@extends('layouts.app')

@section('title', 'Create Area')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" role="form" method="POST" action="{{ route('area.store') }}">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Create Area
                            <a href="{{ route('area.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
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
                        <div class="form-group form-group-default form-group-default-select2 required @error('city_id') has-error @enderror">
                            <label>City</label>
                            <select class="full-width @error('city_id') error @enderror" name="city_id" data-placeholder="Select a City" data-init-plugin="select2" required>
                                <option value="" data-prefix="">Select a City</option>
                                @forelse ($cities as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('city_id')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group form-group-default @error('delivery_charge') has-error @enderror">
                            <label>Delivery Charge</label>
                            <div class="controls">
                                <input type="text" class="form-control custom-decimal-field @error('delivery_charge') error @enderror" name="delivery_charge" autocomplete="off" value="{{ old('delivery_charge') }}">
                                @error('delivery_charge')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-group-default @error('condition_amount') has-error @enderror">
                            <label>Conditional Amount for free delivery</label>
                            <div class="controls">
                                <input type="text" class="form-control custom-decimal-field @error('condition_amount') error @enderror" name="condition_amount" autocomplete="off" value="{{ old('condition_amount') }}">
                                @error('condition_amount')
                                <label class="error">{{ $message }}</label>
                                @enderror
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
                                    CREATE <span class="visible-x-inline m-l-5">AREA</span>
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
    });
</script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
@endpush