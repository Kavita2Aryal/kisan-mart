@extends('layouts.app')

@section('title', 'Create Gift Voucher')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" id="form" role="form" method="POST" action="{{ route('gift.voucher.store') }}" data-hyperlink-search="{{ route('web.alias.hyperlink.search', [0]) }}">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-7 col-xlg-7">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Create Gift Voucher
                            <a href="{{ route('gift.voucher.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group form-group-default input-group required @error('code') has-error @enderror">
                            <div class="form-input-group">
                                <label>Code</label>
                                <input name="code" type="text" class="form-control gift-voucher @error('code') error @enderror" required autocomplete="off" value="{{ old('code') }}">
                            </div>
                            <div class="input-group-prepend">
                                <a class="btn btn-link btn-link-fix text-danger p-l-20 p-r-20 btn-generate-code">Generate Code</a>
                            </div>
                        </div>
                        @error('code')
                        <label class="error">{{ $message }}</label>
                        @enderror
                        <div class="form-group required form-group-default @error('title') has-error @enderror">
                            <label>Title</label>
                            <div class="controls">
                                <input name="title" type="text" class="form-control alias-source @error('title') error @enderror" required autocomplete="off" value="{{ old('title') }}">
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
                            <div class="form-input-group">
                                <input type="text" class="form-control alias-value alias-check p-b-5 @error('alias') error @enderror" name="alias" placeholder="Web Alias" required autocomplete="off" value="{{ old('alias') }}">
                                <input type="hidden" class="alias-index" name="alias_id" value="0">
                            </div>
                        </div>
                        @php $indexing = indexing(); @endphp
                        <div class="form-group editor-description @error('description') has-error @enderror" data-index="{{ $indexing }}">
                            <textarea class="editor-container editor-container-{{ $indexing }} @error('description') error @enderror" name="description">{{ old('description') }}</textarea>
                            @error('description')
                            <label class="error">{{ $errors->first('description') }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                                <div class="form-group required form-group-default @error('value') has-error @enderror">
                                    <label>Value</label>
                                    <div class="controls">
                                        <input name="value" type="number" class="form-control @error('value') error @enderror" required placeholder="Gift Voucher Worth Rupees" autocomplete="off" value="{{ old('value') }}">
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
                                        <input name="price" type="number" class="form-control @error('price') error @enderror" required placeholder="Gift Voucher Price" autocomplete="off" value="{{ old('price') }}">
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
                                        <input type="text" class="form-control start-date @error('start_date') error @enderror" name="start_date" placeholder="Pick a start date" autocomplete="off" value="{{ old('start_date') }}" data-provide="datepicker-inline">
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
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-check info m-t-0 m-b-0">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" checked>
                                    <label for="checkbox-active">Publish ?</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    CREATE <span class="visible-x-inline m-l-5">GIFT VOUCHER</span>
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
                        <input type="hidden" name="image" class="gift-voucher-image" value="" />
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