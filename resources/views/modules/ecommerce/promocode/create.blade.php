@extends('layouts.app')

@section('title', 'Create PromoCode')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" id="form" role="form" method="POST" action="{{ route('promocode.store') }}" data-hyperlink-search="{{ route('web.alias.hyperlink.search', [0]) }}">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Create PromoCode
                            <a href="{{ route('promocode.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group form-group-default input-group required @error('code') has-error @enderror">
                            <div class="form-input-group">
                                <label>Promo Code</label>
                                <input name="code" type="text" class="form-control promocode @error('code') error @enderror" required autocomplete="off" value="{{ old('code') }}">
                            </div>
                            <div class="input-group-prepend">
                                <a class="btn btn-link btn-link-fix text-danger p-l-20 p-r-20 btn-generate-code">Generate Code</a>
                            </div>
                        </div>
                        @error('code')
                        <label class="error">{{ $message }}</label>
                        @enderror
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                                <div class="form-group required form-group-default @error('minimum_purchase') has-error @enderror">
                                    <label>Minimum Purchase Amount</label>
                                    <div class="controls">
                                        <input name="minimum_purchase" type="number" class="form-control @error('minimum_purchase') error @enderror" required autocomplete="off" value="{{ old('minimum_purchase') }}">
                                        @error('minimum_purchase')
                                        <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                                <div class="form-group required form-group-default @error('maximum_usage') has-error @enderror">
                                    <label>Maximum No. of Usage</label>
                                    <div class="controls">
                                        <input name="maximum_usage" type="number" class="form-control @error('maximum_usage') error @enderror" required autocomplete="off" value="{{ old('maximum_usage') }}">
                                        @error('maximum_usage')
                                        <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-15">
                            <div class="col-sm-12">
                                <p><strong>Effective Date</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                                <div class="form-group form-group-default input-group @error('start_date') has-error @enderror required">
                                    <div class="form-input-group">
                                        <label>Start Date</label>
                                        <input type="text" class="form-control start-date @error('start_date') error @enderror" name="start_date" required placeholder="Pick a start date" autocomplete="off" value="{{ old('start_date') }}" data-provide="datepicker-inline">
                                        @error('start_date')
                                        <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="pg-icon">calendar</i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                                <div class="form-group form-group-default input-group @error('end_date') has-error @enderror">
                                    <div class="form-input-group">
                                        <label>End Date</label>
                                        <input type="text" class="form-control end-date @error('end_date') error @enderror" name="end_date" placeholder="Pick a end date" autocomplete="off" value="{{ old('end_date') }}" data-provide="datepicker-inline">
                                        @error('enddate')
                                        <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="pg-icon">calendar</i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-15 m-b-10">
                            <div class="col-sm-12">
                                <strong>Effective Discount</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="discount_type" id="fixed-amount" value="1" checked>
                                    <label class="form-check-label" for="fixed-amount">Fixed Amount</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="discount_type" id="percentage" value="2">
                                    <label class="form-check-label" for="percentage">Percentage</label>
                                </div>
                            </div>
                            @error('discount_type')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                                <div class="form-group required form-group-default @error('discount') has-error @enderror">
                                    <label>Discount</label>
                                    <div class="controls">
                                        <input name="discount" type="number" class="form-control @error('discount') error @enderror" required autocomplete="off" value="{{ old('discount') }}">
                                        @error('discount')
                                        <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-15 m-b-10">
                            <div class="col-sm-12">
                                <strong>Effective Products</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="all-products" value="1" checked>
                                    <label class="form-check-label" for="all-products">Applied To All</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="include-products" value="2">
                                    <label class="form-check-label" for="include-products">Include Products</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="exclude-products" value="3">
                                    <label class="form-check-label" for="exclude-products">Exclude Products</label>
                                </div>
                            </div>
                            @error('type')
                            <label class="error">{{ $message }}</label>
                            @enderror
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
                                    CREATE <span class="visible-x-inline m-l-5">PROMOCODE</span>
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

@include('modules.ecommerce.promocode.assets')