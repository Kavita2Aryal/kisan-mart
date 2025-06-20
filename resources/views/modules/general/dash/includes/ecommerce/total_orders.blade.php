<div class="card bg-complete">
    <div class="card-header">
        <div class="card-title hint-text">
            <span class="font-montserrat fs-11 all-caps text-white">Orders</span>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-2 hidden-1024">
                <img src="{{ asset('assets/img/cms-icons/ecommerce/order.svg') }}" alt="website vistors" width="65">
            </div>
            <div class="col-sm-12 col-md-8 col-lg-9 col-xlg-10 full-width-1024">
                <p class="font-montserrat fs-18 m-t-5">
                    Domestic : &nbsp;{{ $country_wise_orders['domestic_orders'] }}
                </p>
                <p class="font-montserrat fs-18 m-b-0">
                    International : &nbsp;{{ $country_wise_orders['international_orders'] }}
                </p>
            </div>
        </div>
    </div>
</div>