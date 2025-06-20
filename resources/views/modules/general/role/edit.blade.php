@extends('layouts.app')
@section('title', 'Update Access Role')

@section('content')
<div class="container-fluid">
    <form role="form" class="m-t-20" method="POST" action="{{ route('role.update', [$role->uuid]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Update Access Role
                            <a href="{{ route('role.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group required form-group-default @error('role') has-error @enderror">
                            <label>Access Role</label>
                            <input type="text" class="form-control @error('role') error @enderror" name="role" required autocomplete="off" autofocus value="{{ $role->role }}">
                            @error('role')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-check info">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" @if($role->is_active == 10) checked @endif>
                                    <label for="checkbox-active">Active ?</label>
                                </div>
                                <div class="form-check info m-b-0">
                                    <input type="checkbox" class="permit-all" id="checkbox-all-permission">
                                    <label for="checkbox-all-permission">Permit all modules</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 m-t-10">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-submit pull-right" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">ACCESS ROLE</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8">
                @includeWhen(($role->is_super == 0), 'modules.general.role.includes.permissions', ['data' => $role])
            </div>
        </div>
    </form>
</div>
@endsection