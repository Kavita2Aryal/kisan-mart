@extends('layouts.app')

@section('title', 'Update Collection')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" id="form" role="form" method="POST" action="{{ route('collection.update', [$collection->uuid]) }}" data-hyperlink-search="{{ route('web.alias.hyperlink.search', [0]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-7 col-xlg-7">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Update Collection
                            <a href="{{ route('collection.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if ($collection_types != null)
                                @foreach ($collection_types as $key => $type)
                                <div class="form-check form-check-inline complete">
                                    <input class="alias-level-1 alias-level-source" type="radio" name="collection_type" id="collection-type-{{ $key }}" data-alias="{{ Str::slug($type, '-') }}" value="{{ $key }}" @if ($key == $collection->collection_type) checked @endif>
                                    <label for="collection-type-{{ $key }}">{{ $type }}</label>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="form-group required form-group-default @error('name') has-error @enderror">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control alias-level-2 alias-level-source @error('name') error @enderror" required autocomplete="off" value="{{ $collection->name ?? old('name') }}">
                            @error('name')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group form-group-default required input-group alias-edit @error('alias') has-error @enderror" style="display:none;">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="pg-icon m-r-5">globe</i>
                                    {{ $url }}
                                </span>
                            </div>
                            <div class="form-input-group">
                                <input type="text" class="form-control alias-value alias-check p-b-5 @error('alias') error @enderror" name="alias" placeholder="Web Alias" required autocomplete="off" value="{{ $collection->alias->alias ?? old('alias') }}">
                                <input type="hidden" class="alias-index" name="alias_id" value="{{ $collection->alias->id }}">
                            </div>
                        </div>
                        @error('alias')
                        <div class="alias-error">
                            <label class="error">{{ $message }}</label>
                        </div>
                        @enderror
                        @php $indexing = indexing(); @endphp
                        <div class="form-group editor-description @error('description') has-error @enderror" data-index="{{ $indexing }}">
                            <textarea class="editor-container editor-container-{{ $indexing }} @error('description') error @enderror" name="description">{{ $collection->description ?? old('description') }}</textarea>
                            @error('description')
                            <label class="error">{{ $errors->first('description') }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-check info m-t-0 m-b-0">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" @if($collection->is_active == 10) checked @endif>
                                    <label for="checkbox-active">Publish ?</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">COLLECTION</span>
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
                            Upload - Collection Image
                        </div>
                    </div>
                    <div class="card-body no-scroll no-padding">
                        <div class="dropzone no-margin">
                            <div class="fallback">
                                <input type="file" accept="image/*">
                            </div>
                        </div>
                        <input type="hidden" name="image" class="collection-image" value="{{ $collection->image ?? old('image') }}" />
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

@include('modules.ecommerce.collection.assets')