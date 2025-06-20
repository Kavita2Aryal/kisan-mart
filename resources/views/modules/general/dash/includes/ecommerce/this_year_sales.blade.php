<div class="card bg-success-dark">
    <div class="card-header">
        <div class="card-title hint-text">
            <span class="font-montserrat fs-11 all-caps text-white">This Year Sales</span>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-3 col-xlg-2 hidden-1024">
                <img src="{{ asset('assets/img/cms-icons/ecommerce/currency.svg') }}" alt="website vistors" width="65">
            </div>
            <div class="col-sm-12 col-md-8 col-lg-9 col-xlg-10 full-width-1024">
                @foreach($this_year_total_sales as $key => $row)
                    <h4 class="no-margin p-b-5 text-white">{{ $key }}. {{ number_format($row, 2) }}</h4>
                @endforeach
                <!-- @if($last_year_total_sales == 0 && $this_year_total_sales == 0)
                <span class="label font-montserrat">No Transaction</span>
                @elseif($yearly_diff > 0)
                <span class="label font-montserrat">{{ round($yearly_percent) }}% Lower than last year</span>
                @else
                <span class="label font-montserrat">{{ round($yearly_percent) }}% Higher than last year</span>
                @endif -->
            </div>
        </div>
    </div>
</div>