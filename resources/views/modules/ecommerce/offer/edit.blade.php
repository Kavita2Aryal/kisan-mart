@extends('layouts.app')

@section('title', 'Update Offer')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" id="form" role="form" method="POST" action="{{ route('offer.update', [$offer->uuid]) }}" data-hyperlink-search="{{ route('web.alias.hyperlink.search', [0]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-7 col-xlg-7">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Update Offer
                            <a href="{{ route('offer.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group required form-group-default @error('name') has-error @enderror">
                            <label>Name</label>
                            <div class="controls">
                                <input name="name" type="text" class="form-control alias-source @error('name') error @enderror" required autocomplete="off" value="{{ $offer->name ?? old('name') }}">
                                @error('name')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group required form-group-default @error('title') has-error @enderror">
                            <label>Title</label>
                            <div class="controls">
                                <input name="title" type="text" class="form-control @error('title') error @enderror" required autocomplete="off" value="{{ $offer->title ?? old('title') }}">
                                @error('title')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-group-default required input-group alias-edit @error('alias') has-error @enderror" style="display:none;">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="pg-icon m-r-5">globe</i>
                                    {{ $url }}
                                </span>
                            </div>
                            <div class="form-input-group">
                                <input type="text" class="form-control alias-value alias-check p-b-5 @error('alias') error @enderror" name="alias" placeholder="Web Alias" required autocomplete="off" value="{{ $offer->alias->alias ?? old('alias') }}">
                                <input type="hidden" class="alias-index" name="alias_id" value="{{ $offer->alias->id }}">
                            </div>
                        </div>
                        @error('alias')
                        <div class="alias-error">
                            <label class="error">{{ $message }}</label>
                        </div>
                        @enderror
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-group-default input-group @error('start_date') has-error @enderror required">
                                    <div class="form-input-group">
                                        <label>Start Date</label>
                                        <input type="text" class="form-control offer-start @error('start_date') error @enderror" name="start_date" placeholder="Pick a start date" autocomplete="off" value="{{ $offer->start_date ?? old('start_date') }}" data-provide="datepicker-inline">
                                        @error('start_date')
                                        <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="pg-icon">calendar</i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default input-group @error('end_date') has-error @enderror">
                                    <div class="form-input-group">
                                        <label>End Date</label>
                                        <input type="text" class="form-control offer-end @error('end_date') error @enderror" name="end_date" placeholder="Pick a end date" autocomplete="off" value="{{ $offer->end_date ?? old('end_date') }}" data-provide="datepicker-inline">
                                        @error('end_date')
                                        <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="pg-icon">calendar</i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-b-15">
                            <div class="col-12">
                                <strong class="m-r-10">Discount Type:</strong>
                                @if ($discount_types != null)
                                @foreach ($discount_types as $key => $type)
                                <div class="form-check form-check-inline complete">
                                    <input type="radio" name="discount_type" id="discount-type-{{ $key }}" value="{{ $key }}" @if ($key == $offer->discount_type) checked @endif>
                                    <label for="discount-type-{{ $key }}">{{ $type }}</label>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        @php $indexing = indexing(); @endphp
                        <div class="form-group editor-description @error('description') has-error @enderror" data-index="{{ $indexing }}">
                            <textarea class="editor-container editor-container-{{ $indexing }} @error('description') error @enderror" name="description">{{ $offer->description ?? old('description') }}</textarea>
                            @error('description')
                            <label class="error">{{ $errors->first('description') }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-check info m-t-0 m-b-0">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" @if($offer->is_active == 10) checked @endif>
                                    <label for="checkbox-active">Publish ?</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">OFFER</span>
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
                            Upload - Offer Image
                        </div>
                    </div>
                    <div class="card-body no-scroll no-padding">
                        <div class="dropzone no-margin">
                            <div class="fallback">
                                <input type="file" accept="image/*">
                            </div>
                        </div>
                        <input type="hidden" name="image" class="offer-image" value="{{ $offer->image ?? old('image') }}" />
                    </div>
                </div>
                @error('image')
                <label class="error">{{ $message }}</label>
                @enderror
            </div>
        </div>
    </form>
</div>

@endsection

@include('modules.ecommerce.offer.assets')