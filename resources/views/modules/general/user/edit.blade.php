@extends('layouts.app')
@section('title', 'Update User')

@section('content')
<div class="container-fluid">
    <form role="form" class="m-t-20" method="POST" action="{{ route('user.update', $user->uuid) }}" data-role-permissions="{{ route('role.permissions') }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xlg-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">Update User
                            <a href="{{ route('user.index') }}" class="normal btn btn-link pull-right m-r-5" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group required form-group-default @error('name') has-error @enderror">
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') error @enderror" name="name" required autocomplete="off" autofocus value="{{ $user->name ?? old('name') }}">
                            @error('name')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group required form-group-default @error('email') has-error @enderror">
                            <label>Email</label>
                            <input type="email" class="form-control @error('email') error @enderror" name="email" required autocomplete="off" value="{{ $user->email ?? old('email') }}">
                            @error('email')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group required form-group-default @error('password') has-error @enderror">
                            <label>Password</label>
                            <input type="password" class="form-control @error('password') error @enderror" name="password" autocomplete="off">
                            @error('password')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group form-group-default @error('password_confirmation') has-error @enderror">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control @error('password_confirmation') error @enderror" name="password_confirmation" autocomplete="off">
                            @error('password_confirmation')
                            <label class="error">{{ $message }}</label>
                            @enderror
                        </div>
                        @if ($user->role_id > 1)
                        <div class="form-group form-group-default input-group required @error('role_id') has-error @enderror">
                            <div class="form-input-group">
                                <label>Access Role</label>
                                <select class="form-control permit-pre-role @error('role_id') error @enderror" name="role_id" required>
                                    @forelse($roles as $role)
                                    <option value="{{ $role->id }}" @if ($role->id == $user->role_id) selected @endif>{{ $role->role }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                @error('role_id')
                                <label class="error">{{ $message }}</label>
                                @enderror 
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                @if (auth()->user()->id != $user->id)
                                <div class="form-check info">
                                    <input type="checkbox" name="is_active" value="10" id="checkbox-active" @if($user->is_active == 10) checked @endif>
                                    <label for="checkbox-active">Active ?</label>
                                </div>
                                @endif
                                @if ($user->role_id > 1)
                                <div class="form-check info m-b-0">
                                    <input type="checkbox" class="permit-all" id="checkbox-all-permission">
                                    <label for="checkbox-all-permission">Permit all modules</label>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 m-t-10">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10 btn-submit pull-right" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">USER</span>
                                </button>
                            </div>
                        </div>  
                        @if ($user->two_factor_secret != null)
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <hr class="m-t-20 m-b-20">
                                <h6 class="text-danger m-t-20">Note: </h6>
                                <p class="text-danger">The user has enabled two factor authentication for their login.</p> 
                                <p class="text-danger">For security reasons, user will require to enable the two factor authentication whenever the profile information is updated.</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-8 col-xlg-8">
                @includeWhen(($user->role->is_super == 0), 'modules.general.role.includes.permissions', ['data' => $user])
            </div>
        </div>
    </form>
</div>
@endsection