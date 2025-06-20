@extends('layouts.app')

@section('title', 'Update Country')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" role="form" method="POST" action="{{ route('country.update', [$country->uuid]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Update Country
                            <a href="{{ route('country.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group required form-group-default @error('country_code') has-error @enderror">
                            <label>Country Code</label>
                            <div class="controls">
                                <input type="text" class="form-control @error('country_code') error @enderror" name="country_code" autocomplete="off" value="{{ $country->country_code ?? old('country_code') }}">
                                @error('country_code')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-group-default required @error('name') has-error @enderror">
                            <label>Name</label>
                            <div class="controls">
                                <input type="text" class="form-control @error('name') error @enderror" name="name" autocomplete="off" value="{{ $country->name ?? old('name') }}">
                                @error('name')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-check info m-t-0 m-b-0">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" @if($country->is_active == 10) checked @endif>
                                    <label for="checkbox-active">Publish ?</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">COUNTRY</span>
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
@endpush

@push('scripts')
@endpush