<div class="widget-11 card">
    <div class="card-header">
        <div class="card-title full-width">
            Daily Sales
            <div class="pull-right">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                        <div class="form-group input-group transparent m-b-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text transparent text-capitalize">From:</span>
                            </div>
                            <input type="text" name="s" class="form-control ignore-navigate-away datepicker daily-start-date input-sm" readonly="readonly" value="">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xlg-6">
                        <div class="form-group input-group transparent m-b-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text transparent text-capitalize">To:</span>
                            </div>
                            <input type="text" name="e" class="form-control ignore-navigate-away datepicker daily-end-date input-sm" readonly="readonly" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="min-height-400">
            <canvas id="line-chart-last-30-days"></canvas>
        </div>
    </div>
</div>