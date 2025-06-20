<div class="card-header">
    <h5 class="no-margin">
        Order Manager
        <a href="{{ route('order.export.csv') }}" target="_blank" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
            <i class="pg-icon m-r-5">download</i><span class="visible-x-inline m-r-5">EXPORT</span> CSV
        </a>
        <a href="{{ route('order.select.items') }}" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 pull-right m-r-5">
            <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">ORDER</span>
        </a>
    </h5>
</div>
<ul class="nav nav-tabs nav-tabs-simple" role="tablist">
    <li class="nav-item">
        <a class="{{ route_is('order.pending') == true ? 'active' : '' }}" href="{{ route('order.pending') }}">Pending Orders</a>
    </li>
    <li class="nav-item">
        <a class="{{ route_is('order.confirmed') == true ? 'active' : '' }}" href="{{ route('order.confirmed') }}">Confirmed Orders</a>
    </li>
    <li class="nav-item">
        <a class="{{ route_is('order.shipped') == true ? 'active' : '' }}" href="{{ route('order.shipped') }}">Shipped Orders</a>
    </li>
    <li class="nav-item">
        <a class="{{ route_is('order.delivered') == true ? 'active' : '' }}" href="{{ route('order.delivered') }}">Delivered Orders</a>
    </li>
    <li class="nav-item">
        <a class="{{ route_is('order.cancelled') == true ? 'active' : '' }}" href="{{ route('order.cancelled') }}">Cancelled Orders</a>
    </li>
    <li class="nav-item">
        <a class="{{ route_is('order.refund') == true ? 'active' : '' }}" href="{{ route('order.refund') }}">Refund Orders</a>
    </li>
</ul>