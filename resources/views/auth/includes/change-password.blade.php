<div class="row">
    <div class="col-xl-5 col-lg-5">
        <h4>Update Password</h4>
        <p>Ensure your account is using a long, random password to stay secure.</p>
        <ul>
            <li>At least 8 characters—the more characters, the better</li>
            <li>A mixture of both uppercase and lowercase letters</li>
            <li>A mixture of letters and numbers</li>
            <li>Inclusion of at least one special character, e.g., ! @ # ? ] <br/>Note: do not use < or > in your password, as both can cause problems in Web browsers</li>
        </ul>
    </div> 
    <div class="col-xl-7 col-lg-7">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('user-password.update') }}">
                    @csrf   
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default required @if($errors->getBag('updatePassword')->has('current_password')) has-error @endif">
                                <label>Current Password</label>
                                <input type="password" name="current_password" class="form-control" required autocomplete="off"/>
                                @if($errors->getBag('updatePassword')->has('current_password'))
                                    <label class="error">{{ $errors->getBag('updatePassword')->first('current_password') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default required @if($errors->getBag('updatePassword')->has('password')) has-error @endif">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-control use-password" required autocomplete="new-password"/>
                                @if($errors->getBag('updatePassword')->has('password'))
                                    <label class="error">{{ $errors->getBag('updatePassword')->first('password') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default required @if($errors->getBag('updatePassword')->has('password_confirmation')) has-error @endif">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control use-password" required autocomplete="new-password" />
                                @if($errors->getBag('updatePassword')->has('password_confirmation'))
                                    <label class="error">{{ $errors->getBag('updatePassword')->first('password_confirmation') }}</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">UPDATE PASSWORD</button>
                            </div> 
                        </div>
                    </div>
                </form>
                <hr class="m-t-20 m-b-20">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <input type="text" class="form-control" id="password-suggestion" placeholder="Password Suggestion" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10 text-success" id="btn-use-password" type="button">I have copied the password, use it.</button>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 text-right">
                        <button class="btn btn-link btn-link-fix p-l-10 p-r-10 text-danger" id="btn-generate-password" type="button">GENERATE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>