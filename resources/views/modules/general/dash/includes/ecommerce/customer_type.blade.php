<div class="card bg-theme-orange">
    <div class="card-header">
        <div class="card-title hint-text">
            <span class="font-montserrat fs-11 all-caps text-white">Customer Type</span>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-2 hidden-1024">
                <img src="{{ asset('assets/img/cms-icons/general/visitortype.svg') }}" alt="web page views" width="65">
            </div>
            <div class="col-sm-12 col-md-8 col-lg-9 col-xlg-10 full-width-1024">
                <p class="font-montserrat fs-18 m-t-5">
                    Customer Count: &nbsp;{{ $customers['total_customers'] }}
                </p>
                <p class="font-montserrat fs-18 m-b-0">
                    Returning Customer: &nbsp;{{ $customers['repeated_customers'] }}
                </p>
            </div>
        </div>
    </div>
</div>