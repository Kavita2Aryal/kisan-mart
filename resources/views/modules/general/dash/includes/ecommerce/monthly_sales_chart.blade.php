<div class="ar-2-3">
    <div class="widget-11 card monthly-sales-chart">
        <div class="card-header">
            <div class="card-title full-width">
                Monthly Sales
                <div class="pull-right">
                    <div class="form-group input-group transparent m-b-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text transparent text-capitalize">Year:</span>
                        </div>
                        <select class="form-control monthly-sales-filter input-sm" id="monthly-sales-filter">
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
            <div class="m-b-10 min-height-400">
                <canvas id="bar-chart-monthly"></canvas>
            </div>
        </div>
    </div>
</div>