@extends('layouts.app')

@section('title', 'Update Gift Voucher')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" id="form" role="form" method="POST" action="{{ route('gift.voucher.update', [$gift_voucher->uuid]) }}" data-hyperlink-search="{{ route('web.alias.hyperlink.search', [0]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-7 col-xlg-7">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Update Gift Voucher
                            <a href="{{ route('gift.voucher.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group form-group-default input-group required @error('code') has-error @enderror">
                            <div class="form-input-group">
                                <label>Code</label>
                                <input name="code" type="text" class="form-control gift-voucher @error('code') error @enderror" required autocomplete="off" value="{{ $gift_voucher->code ?? old('code') }}" readonly style="color:black;">
                            </div>
                            <div class="input-group-prepend">
                                <a class="btn btn-link btn-link-fix text-danger p-l-20 p-r-20">Generate Code</a>
                            </div>
                        </div>
                        @error('code')
                        <label class="error">{{ $message }}</label>
                        @enderror
                        <div class="form-group required form-group-default @error('title') has-error @enderror">
                            <label>Title</label>
                            <div class="controls">
                                <input name="title" type="text" class="form-control alias-source @error('title') error @enderror" required autocomplete="off" value="{{ $gift_voucher->title ?? old('title') }}">
                                @error('title')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-group-default required input-group alias-edit @error('alias') has-error @enderror">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="pg-icon m-r-5">globe</i>
                                    {{ $url.'gift-voucher/' }}
                                </span>
                            </div>
                            @php 
                                $alias = $gift_voucher->alias->alias;
                                $split = explode('gift-voucher/', $alias);
                            @endphp
                            <div class="form-input-group">
                                <input type="text" class="form-control alias-value alias-check p-b-5 @error('alias') error @enderror" name="alias" placeholder="Web Alias" required autocomplete="off" value="{{ $split[1] ?? old('alias') }}">
                                <input type="hidden" class="alias-index" name="alias_id" value="{{ $gift_voucher->alias->id }}">
                            </div>
                        </div>
                        @php $indexing = indexing(); @endphp
                        <div class="form-group editor-description @error('description') has-error @enderror" data-index="{{ $indexing }}">
                            <textarea class="editor-container editor-container-{{ $indexing }} @error('description') error @enderror" name="description">{{ $gift_voucher->description ?? old('description') }}</textarea>
                            @error('description')
                            <label class="error">{{ $errors->first('description') }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                                <div class="form-group required form-group-default @error('value') has-error @enderror">
                                    <label>Value</label>
                                    <div class="controls">
                                        <input name="value" type="number" class="form-control @error('value') error @enderror" required placeholder="Gift Voucher Worth Rupees" autocomplete="off" value="{{ $gift_voucher->value ?? old('value') }}">
                                        @error('value')
                                        <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                                <div class="form-group required form-group-default @error('price') has-error @enderror">
                                    <label>Price</label>
                                    <div class="controls">
                                        <input name="price" type="number" class="form-control @error('price') error @enderror" required placeholder="Gift Voucher Price" autocomplete="off" value="{{ $gift_voucher->price ?? old('price') }}">
                                        @error('price')
                                        <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                                <div class="form-group form-group-default input-group @error('start_date') has-error @enderror">
                                    <div class="form-input-group">
                                        <label>Start Date</label>
                                        <input type="text" class="form-control start-date @error('start_date') error @enderror" name="start_date" placeholder="Pick a start date" autocomplete="off" value="{{ $gift_voucher->start_date ?? old('start_date') }}" data-provide="datepicker-inline">
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
                                        <input type="text" class="form-control end-date @error('end_date') error @enderror" name="end_date" placeholder="Pick a end date" autocomplete="off" value="{{ $gift_voucher->end_date ?? old('end_date') }}" data-provide="datepicker-inline">
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
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-check info m-t-0 m-b-0">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" @if($gift_voucher->is_active == 10) checked @endif>
                                    <label for="checkbox-active">Publish ?</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">GIFT VOUCHER</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-5 col-xlg-5">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Upload - Gift Voucher Image
                        </div>
                    </div>
                    <div class="card-body no-scroll no-padding">
                        <div class="dropzone no-margin">
                            <div class="fallback">
                                <input type="file" accept="image/*">
                            </div>
                        </div>
                        <input type="hidden" name="image" class="gift-voucher-image" value="{{ $gift_voucher->image ?? old('image') }}" />
                    </div>
                </div>
                @if ($errors->has('image'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </form>
</div>

@endsection

@include('modules.ecommerce.gift-voucher.assets')