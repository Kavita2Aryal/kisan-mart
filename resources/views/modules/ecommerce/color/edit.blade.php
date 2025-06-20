@extends('layouts.app')

@section('title', 'Update Color')

@section('content')
<div class="container-fluid">
    <form class="m-t-20" role="form" method="POST" action="{{ route('color.update', [$color->uuid]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6 col-xlg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Update Color
                            <a href="{{ route('color.index') }}" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group required form-group-default input-group @error('color_group') has-error @enderror">
                            <div class="form-input-group">
                                <label>Color Group</label>
                                <select class="full-width form-control color-group @error('color_group') error @enderror" name="color_group" data-placeholder="Select a Color Group">
                                    <option value="" selected>Select a Color Group</option>
                                    @if ($color_groups != null)
                                    @foreach ($color_groups as $row)
                                    <option value="{{ $row->id }}" {{ $row->id == ($color->color_group_id) ? 'selected' : '' }}>{{ $row->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @error('color_group')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-group-default required @error('name') has-error @enderror">
                            <label>Name</label>
                            <div class="controls">
                                <input type="text" class="form-control @error('name') error @enderror" name="name" autocomplete="off" value="{{ $color->name ?? old('name') }}">
                                @error('name')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group form-group-default @error('value') has-error @enderror">
                            <label>Hex Value</label>
                            <div class="controls">
                                <input type="text" class="form-control @error('value') error @enderror" name="value" placeholder="eg: #F0F0F0" autocomplete="off" value="{{ $color->value ?? old('value') }}">
                                @error('value')
                                <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-check info m-t-0 m-b-0">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" @if($color->is_active == 10) checked @endif>
                                    <label for="checkbox-active">Publish ?</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">COLOR</span>
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
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('.color-group').select2({});
    });
</script>
@endpush