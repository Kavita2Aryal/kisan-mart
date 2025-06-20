<div class="card bg-success-dark">
    <div class="card-header">
        <div class="card-title hint-text">
            <span class="font-montserrat fs-11 all-caps text-white">Unfinished Orders</span>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-2 hidden-1024">
                <img src="{{ asset('assets/img/cms-icons/ecommerce/order.svg') }}" alt="website vistors" width="65">
            </div>
            <div class="col-sm-12 col-md-8 col-lg-9 col-xlg-10 full-width-1024">
                <h4 class="no-margin p-b-5 text-white semi-bold">{{ $unfinished_orders }}</h4>
                <span class="label font-montserrat">{{ number_format($unfinished_orders_percent, 0, '', ',') . '%' }} Orders Not Delivered</span>
            </div>
        </div>
    </div>
</div>