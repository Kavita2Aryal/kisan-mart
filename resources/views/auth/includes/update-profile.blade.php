<div class="row m-t-30">
    <div class="col-xl-5 col-lg-5">
        <h4>Profile Information</h4>
        <p>Update your account's profile information and email address.</p>
        @if ($profile->two_factor_secret != NULL)
        <h6 class="text-danger m-t-20">Note: </h6>
        <p class="text-danger">For security reasons, user will require to enable the two factor authentication whenever the profile information is updated.</p>
        @endif
    </div>
    <div class="col-xl-7 col-lg-7">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('user-profile-information.update') }}">
                    @csrf   
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default required @error('name') has-error @enderror">
                                <label>Your Name</label>
                                <input type="text" name="name" class="form-control" required autocomplete="off" value="{{ $profile->name }}" />
                                @error('name')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default required @error('name') has-error @enderror">
                                <label>Your Email (Username)</label>
                                <input type="email" name="email" class="form-control" required autocomplete="off" value="{{ $profile->email }}" />
                                @error('email')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">UPDATE PROFILE</button>
                            </div> 
                        </div>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>