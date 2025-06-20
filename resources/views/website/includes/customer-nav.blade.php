<div class="uk-section-default uk-section">
    <div class="uk-container">
        <div class="tm-grid-expand uk-child-width-1-1 uk-grid-margin" uk-grid>
            <div>
                <h1>{{ $title }}</h1>
                <div>
                    @php $request_url = $_SERVER['REQUEST_URI']; @endphp
                    <ul class="uk-margin-remove-bottom uk-tab" uk-margin>
                        <li class="el-item {{ route_is('dashboard') == true ? 'uk-active' : '' }}">
                            <a class="el-link " href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="el-item {{ ($request_url == '/order/history') ? 'uk-active' : '' }}">
                            <a class="el-link " href="{{ route('order.history') }}">Orders</a>
                        </li>
                        <li class="el-item {{ route_is('address') == true ? 'uk-active' : '' }}">
                            <a class="el-link" href="{{ route('address') }}">Address</a>
                        </li>
                        <li class="el-item {{  route_is('profile') == true ? 'uk-active' : '' }}">
                            <a class="el-link" href="{{ route('profile') }}">Account Details</a>
                        </li>
                        <li class="el-item {{ route_is('product.review.index') == true ? 'uk-active' : '' }}">
                            <a class="el-link" href="{{ route('product.review.index') }}">Products To be Reviewed</a>
                        </li>
                        <li class="el-item {{ route_is('product.review.history') == true ? 'uk-active' : '' }}">
                            <a class="el-link" href="{{ route('product.review.history') }}">Product Review History</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>