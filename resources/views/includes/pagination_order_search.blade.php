<form action="{{ url()->current() }}" class="search-parent m-b-10">
    <div class="form-group-attached">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-3 col-xlg-3">
                <div class="form-group form-group-default">
                    <div class="form-input-group">
                        <label>Order Code</label>
                        <input type="search" name="order_code" placeholder="Order Code" class="form-control" value="{{ $paging->order_code }}" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-2 col-xlg-2">
                <div class="form-group form-group-default">
                    <div class="form-input-group">
                        <label>Customer Name</label>
                        <input type="search" name="name" placeholder="Name" class="form-control" value="{{ $paging->name }}" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-2 col-xlg-2">
                <div class="form-group form-group-default">
                    <div class="form-input-group">
                        <label>Customer Phone</label>
                        <input type="search" name="phone" placeholder="Phone" class="form-control" value="{{ $paging->phone }}" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-2 col-xlg-2">
                <div class="form-group form-group-default">
                    <div class="form-input-group">
                        <label>Customer Email</label>
                        <input type="search" name="email" placeholder="Email" class="form-control" value="{{ $paging->email }}" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xlg-3">
                <div class="form-group form-group-default input-group">
                    <div class="form-input-group">
                        <label>Items Per Page</label>
                        <select name="limit" class="form-control">
                            <option value="10" @if($paging->limit == 10) selected @endif>10 items</option>
                            <option value="25" @if($paging->limit == 25) selected @endif>25 items</option>
                            <option value="50" @if($paging->limit == 50) selected @endif>50 items</option>
                            <option value="100" @if($paging->limit == 100) selected @endif>100 items</option>
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