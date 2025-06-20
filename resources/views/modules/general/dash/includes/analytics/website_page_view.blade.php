<div class="card">
    <div class="card-header">
        <div class="card-title full-width">Website Page View</div>
    </div>
    <div class="card-body p-t-15">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-2">
                <img src="{{ asset('assets/img/cms-icons/general/views.svg') }}" alt="web page views" width="60">
            </div>
            <div class="col-sm-12 col-md-8 col-lg-9 col-xlg-10">
                <h5 class="font-montserrat fs-18 m-t-0">
                    Yesterday: &nbsp;{{ number_format($yesterday_total_visitors_and_page_views['total_page_views'], 0, '', ',') }}
                </h5>
                <p class="font-montserrat fs-18">
                    This Week: &nbsp;{{ number_format($last7Days_total_visitors_and_page_views['total_page_views'], 0, '', ',') }}
                </p>
                <p class="font-montserrat fs-18 m-b-0">
                    This Month: &nbsp;{{ number_format($last30Days_total_visitors_and_page_views['total_page_views'], 0, '', ',') }}
                </p>
            </div>
        </div>
    </div>
</div>