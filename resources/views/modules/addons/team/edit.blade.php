@extends('layouts.app')
@section('title', 'Update Team Member')

@section('content')
<div class="container-fluid">
    <form role="form" class="m-t-20" method="POST" action="{{ route('team.update', [$team->uuid]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Update Team Member 
                            <a href="{{ route('team.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group required form-group-default input-group @error('group_id') has-error @enderror">
                            <div class="form-input-group">
                                <label>Group</label>
                                <select name="group_id" class="form-control @error('group_id') error @enderror" required>
                                    <option value="" selected>Select a group</option>
                                    @forelse ($groups as $key => $group)
                                        <option value="{{ $key }}" @if($key==$team->group_id) selected @endif>{{ $group }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('group_id')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group required form-group-default @error('name') has-error @enderror">
                            <label>Team Member</label>
                            <input type="text" class="form-control @error('name') error @enderror" name="name" required autocomplete="off" value="{{ $team->name ?? old('name') }}">
                            @error('name')
                                <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group form-group-default @error('description') has-error @enderror">
                            <label>Description</label>
                            <textarea class="form-control @error('description') error @enderror" name="description" style="height:100px;">{{ $team->description ?? old('description') }}</textarea>
                            @error('description')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <button type="button" class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-lg open-use-media" data-type-media="single" data-populate-value=".populate-value-member" data-populate-media=".populate-container-member" id="{{ indexing() }}"><i class="pg-icon m-r-5">image</i> Browse Image</button>
                                @error('image_id')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row m-t-10 m-b-10">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input type="hidden" name="image_id" class="populate-value-member" value="{{ $team->image_id }}">
                                <div class="populate-container populate-container-member m-b-10">
                                    @if ($team->image_id > 0 && isset($team->image->image))
                                    <div class="populate-media">
                                        <a href="{{ secure_img($team->image->image, '1200') }}" target="_blank">
                                            <img src="{{ secure_img($team->image->image, '480X320') }}" class="full-width">
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-check info m-b-0">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" @if($team->is_active==10) checked @endif>
                                <label for="checkbox-active">Publish ?</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">TEAM MEMBER</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@include('modules.cms.media.use.script')

@endsection