<div class="row m-t-30">
    <div class="col-xl-4 col-lg-4">
        <h4>Website Details</h4>
        <p>Update website's informations and email address.</p>
    </div>
    <div class="col-xl-8 col-lg-8">
		<div class="card">
			<div class="card-body">
				<form method="post" action="{{ route('setting.update') }}">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-group-default required @error('setting.isrequired.website-title') has-error @enderror">
								<label>Website Title</label>
								<input type="text" name="setting[isrequired][website-title]" class="form-control" required autocomplete="off" value="{{ $data['website-title'] }}"/>
								@error('setting.isrequired.website-title')
                                    <label class="error">{{ $message }}</label>
                                @enderror
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-group-default required @error('setting.isrequired.website-domain') has-error @enderror">
								<label>Website Domain</label>
								<input type="text" name="setting[isrequired][website-domain]" class="form-control" required autocomplete="off" value="{{ $data['website-domain'] }}"/>
								@error('setting.isrequired.website-domain')
                                    <label class="error">{{ $message }}</label>
                                @enderror
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-group-default required @error('setting.isrequired.admin-email') has-error @enderror">
								<label>Admin Email</label>
								<input type="email" name="setting[isrequired][admin-email]" class="form-control" required autocomplete="off" value="{{ $data['admin-email'] }}"/>
								@error('setting.isrequired.admin-email')
                                    <label class="error">{{ $message }}</label>
                                @enderror
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-group-default required @error('setting.isrequired.noreply-email') has-error @enderror">
								<label>Noreply Email</label>
								<input type="email" name="setting[isrequired][noreply-email]" class="form-control" required autocomplete="off" value="{{ $data['noreply-email'] }}"/>
								@error('setting.isrequired.noreply-email')
                                    <label class="error">{{ $message }}</label>
                                @enderror
							</div>
						</div>
					</div>
					@can('setting.update')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-right m-b-0">
                                <button class="btn btn-link btn-link-fix p-l-10 p-r-10" type="submit">
                                    UPDATE <span class="visible-x-inline m-l-5">SETTINGS</span>
                                </button>
                            </div> 
                        </div>
                    </div>
                    @endcan
				</form>
			</div> 
		</div>
	</div>
</div>