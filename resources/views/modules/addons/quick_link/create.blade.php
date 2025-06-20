@extends('layouts.app')
@section('title', 'Create Quick Link')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" role="form" method="POST" action="{{ route('quick.link.store') }}">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Create Quick Link 
                            <a href="{{ route('quick.link.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group required form-group-default input-group @error('group_id') has-error @enderror">
                            <div class="form-input-group">
                                <label>Group</label>
                                <select name="group_id" class="form-control @error('group_id') error @enderror" required>
                                    <option value="" selected>Select a group</option>
                                    @forelse ($groups as $key => $group)
                                        <option value="{{ $key }}" @if(old('group_id')==$key) selected @endif>{{ $group }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('group_id')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group required form-group-default @error('title') has-error @enderror">
                            <label>Title</label>
                            <div class="controls">
                                <input type="text" class="form-control @error('title') error @enderror" name="title" required autocomplete="off" value="{{ old('title') }}">
                                @error('title')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-group-default input-group @error('link') has-error @enderror">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="pg-icon">globe</i></span>
                            </div>
                            <div class="form-input-group">
                                <label>Quick Link</label>
                                <input type="url" class="form-control @error('link') error @enderror" name="link" required autocomplete="off" value="{{ old('link') }}">
                                @error('link')
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
                                    CREATE <span class="visible-x-inline m-l-5">QUICK LINK</span>
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