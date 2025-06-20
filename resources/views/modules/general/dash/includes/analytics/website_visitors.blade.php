<div class="card">
    <div class="card-header">
        <div class="card-title full-width">Website Visitors</div>
    </div>
    <div class="card-body p-t-15">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-2">
                <img src="{{ asset('assets/img/cms-icons/general/visitors.svg') }}" alt="website vistors" width="65">
            </div>
            <div class="col-sm-12 col-md-8 col-lg-9 col-xlg-10">
                <h5 class="font-montserrat fs-18 m-t-0">
                    Yesterday: &nbsp;{{ number_format($yesterday_total_visitors_and_page_views['total_visitors'], 0, '', ',') }}
                </h5>
                <p class="font-montserrat fs-18">
                    This Week: &nbsp;{{ number_format($last7Days_total_visitors_and_page_views['total_visitors'], 0, '', ',') }}
                </p>
                <p class="font-montserrat fs-18 m-b-0">
                    This Month: &nbsp;{{ number_format($last30Days_total_visitors_and_page_views['total_visitors'], 0, '', ',') }}
                </p>
            </div>
        </div>
    </div>
</div>