<form action="{{ url()->current() }}" class="search-parent m-b-10">
    <div class="form-group-attached">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4 col-xlg-4">
                <div class="form-group form-group-default input-group">
                    <div class="form-input-group">
                        <label>From:</label>
                        <div id="datepicker-component" class="input-group date">
                            <input type="text" name="s" class="form-control ignore-navigate-away datepicker start-date" readonly="readonly" value="{{ (isset($_GET['s']) && $_GET['s'] != null) ? $_GET['s'] : '' }}"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xlg-4">
                <div class="form-group form-group-default input-group">
                    <div class="form-input-group">
                        <label>To:</label>
                        <div id="datepicker-component" class="input-group date">
                            <input type="text" name="e" class="form-control ignore-navigate-away datepicker end-date" readonly="readonly" value="{{ (isset($_GET['e']) && $_GET['e'] != null) ? $_GET['e'] : '' }}"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xlg-4">
                <div class="form-group form-group-default input-group">
                    <div class="form-input-group">
                        <label>Items Per Page</label>
                        <select name="limit" class="form-control">
                            <option value="10" @if($data->perPage() == 10) selected @endif>10 items</option>
                            <option value="25" @if($data->perPage() == 25) selected @endif>25 items</option>
                            <option value="50" @if($data->perPage() == 50) selected @endif>50 items</option>
                            <option value="100" @if($data->perPage() == 100) selected @endif>100 items</option>
                        </select>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <button type="submit" class="normal btn btn-link btn-lg"><i class="pg-icon">search</i></button>
                        </span>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <a href="{{ url()->current() }}" class="normal btn btn-link btn-lg"><i class="pg-icon">refresh</i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>