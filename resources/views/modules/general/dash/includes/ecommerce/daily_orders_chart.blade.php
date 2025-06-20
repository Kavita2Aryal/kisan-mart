<div class="widget-11 card">
    <div class="card-header">
        <div class="card-title full-width">
            Orders by day
            <div class="pull-right">
                <div class="form-group input-group transparent m-b-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text transparent text-capitalize">Year:</span>
                    </div>
                    <select class="form-control order-by-day-filter input-sm" id="order-by-day-filter">
                        @for($i=0; $i<=$difference; $i++) 
                            @php $value=$start_year + $i; @endphp 
                            <option value="{{$value}}" @if($value==$current_year) selected @endif>{{ $value }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="min-height-400">
            <canvas id="order-by-day-matrix-chart"></canvas>
        </div>
    </div>
</div>