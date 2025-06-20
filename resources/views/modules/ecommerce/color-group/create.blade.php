@extends('layouts.app')

@section('title', 'Create Color Group')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" role="form" method="POST" action="{{ route('color.group.store') }}">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Create Color Group
                            <a href="{{ route('color.group.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
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
                        <div class="form-group form-group-default @error('value') has-error @enderror">
                            <label>Hex Value</label>
                            <div class="controls">
                                <input type="text" class="form-control @error('value') error @enderror" name="value" placeholder="eg: #F0F0F0" autocomplete="off" value="{{ old('value') }}">
                                @error('value')
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
                                    CREATE <span class="visible-x-inline m-l-5">COLOR GROUP</span>
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