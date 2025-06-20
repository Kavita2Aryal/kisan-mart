@php 
$permissions = config('app.permissions'); 
$check_permissions = ($data != null) ? array_keys($data->permissions()) : null;
@endphp

<div class="row m-b-30">
    <div class="col-sm-12 col-md-12 col-lg-12">
    	@if(session('permission-error'))
            <label class="error">Please select some permissions</label>
        @endif
        <div class="permission-masonry">
            @forelse ($permissions as $module => $permission)
            <div class="permission-masonry-item permit-parent">
                <div class="card m-b-0">
                    <div class="card-header">
                        <div class="card-title full-width">
                            <a href="#" class="normal btn btn-link permit-module-select">
                                <strong>{{ str_replace('.', ' ', $module) }} permission</strong>
                            </a>
                            <a href="#" class="normal btn btn-link pull-right permit-module-clear" data-tippy-content="Clear Selected" data-tippy-placement="left"><i class="pg-icon">refresh_alt</i></a>
                            <a href="#" class="normal btn btn-link pull-right permit-module-select" data-tippy-content="Select All" data-tippy-placement="left"><i class="pg-icon">tick</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        @forelse ($permission as $key => $permit)
                        <div>
                            <a href="#" class="normal btn btn-link">
                                <div class="form-check info m-t-0 m-b-0">
                                    <input type="checkbox" name="permissions[]" class="permit-role" id="permission-{{ $key }}" value="{{ $key }}" @if($check_permissions && in_array($key, $check_permissions)) checked @endif>
                                    <label for="permission-{{ $key }}">
                                        {{ str_replace('.', ' ', $permit) }}
                                    </label>
                                </div>
                            </a>
                        </div>
                        @empty
                        <h5>No permission to display</h5>
                        @endforelse
                    </div>
                </div>
            </div>
            @empty
            <h5>No system permission registered to display</h5>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/js/role.min.js') }}"></script>
@endpush