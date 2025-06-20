<div class="row m-t-30 m-b-20">
    <div class="col-sm-12 col-md-12 col-lg-12 col-xlg-12">
    	<form action="{{ url()->current() }}" method="get">
	    	<div class="form-group-attached">
	    		<div class="row">
	    			<div class="col-sm-12 col-md-8 col-lg-9 col-xlg-10">
					    <div class="form-group form-group-default input-group">
					        <div class="form-input-group">
					            <label>Search Media Gallery</label>
					            <input type="text" name="search" class="form-control" value="{{ request()->search }}" autocomplete="off" placeholder="e.g. 'mountain, river'">
					        </div>
					    </div>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-3 col-xlg-2">
					    <div class="form-group form-group-default input-group">
					    	<div class="input-group-append">
					            <span class="input-group-text">
					                <button type="submit" class="normal btn btn-link btn-lg btn-ignore-loading">
					                	<i class="pg-icon">search</i>
					                </button>
					            </span>
					        </div>
					        <div class="input-group-append">
					            <span class="input-group-text">
					                <a href="{{ url()->current() }}" class="normal btn btn-link btn-lg">
					                	<i class="pg-icon">refresh_alt</i>
					                </a>
					            </span>
					        </div>
					        @can('media.all')
					        <div class="input-group-append">
					            <span class="input-group-text">
					                <a href="{{ route('media.upload') }}" class="normal btn btn-link btn-lg btn-block p-r-20 p-l-20">
					                	<i class="pg-icon">upload</i> 
					                	<strong class="m-l-10 visible-x-inline">UPLOAD IMAGE</strong>
					                </a>
					            </span>
					        </div>
					        @endcan
					    </div>
					</div>
				</div>
			</div>
		</form>
    </div>
</div>