@extends('layouts.app')

@section('title', 'Update Region')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" role="form" method="POST" action="{{ route('region.update', [$region->uuid]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Update Region
                            <a href="{{ route('region.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group form-group-default required @error('name') has-error @enderror">
                            <label>Name</label>
                            <div class="controls">
                                <input type="text" class="form-control @error('name') error @enderror" name="name" autocomplete="off" value="{{ $region->name ?? old('name') }}">
                                @error('name')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-group-default form-group-default-select2 required @error('country_id') has-error @enderror">
                            <label>Country</label>
                            <select class="full-width @error('country_id') error @enderror" name="country_id" data-placeholder="Select a Country" data-init-plugin="select2" required>
                                <option value="" data-prefix="">Select a Country</option>
                                @forelse ($countries as $row)
                                <option value="{{ $row->id }}" {{ ($row->id == $region->country_id) ? 'selected' : '' }}>{{ $row->name }}</option>
                                @empty
                                @endforelse
                            </select>

                            @error('country_id')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-check info m-t-0 m-b-0">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" @if($region->is_active == 10) checked @endif>
                                    <label for="checkbox-active">Publish ?</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">REGION</span>
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