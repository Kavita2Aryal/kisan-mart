<div class="widget-11 card">
    <div class="card-header">
        <div class="card-title full-width">
            Bounce Rate: &nbsp; <span class="hint-text average-bounce-rate">{{ number_format($bounce_rate['average_bounce_rate'], 0, '', ',') }}%</span> (Average)
            <div class="pull-right">
                <div class="form-group input-group transparent m-b-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text transparent text-capitalize">Year:</span>
                    </div>
                    <select class="form-control bounce-rate-filter input-sm" id="bounce-rate-filter">
                        @for($i=0; $i<=$difference; $i++)
                            @php $value = $start_year + $i; @endphp
                            <option value="{{$value}}" @if($value == $current_year) selected @endif>{{ $value }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="min-height-270">
            <canvas id="bounce-rate-chart"></canvas>
        </div>
    </div>
</div>