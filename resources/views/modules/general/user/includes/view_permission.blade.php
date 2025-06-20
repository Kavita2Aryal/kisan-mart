<div class="card m-b-0" style="box-shadow: none;">
    <div class="card-header no-padding">
        <div class="card-title full-width">
            <strong>{{ $user->name }}</strong> - <strong>{{ $user->role->role }}</strong>
        </div>
    </div>
    <div class="card-body no-padding">
        @php $permissions = $user->permissions(); @endphp
        @if ($permissions == '*')
            <span class="label label-warning">Master permission of all modules</span>
        @else
            @foreach ($permissions as $permission)
            <span class="label label-warning inline m-b-5">{{ $permission }}</span>
            @endforeach
        @endif
    </div>
</div>
                