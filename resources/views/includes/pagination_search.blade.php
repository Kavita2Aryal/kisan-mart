<form action="{{ url()->current() }}" class="search-parent m-b-10">
    <div class="form-group-attached">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-9 col-xlg-9">
                <div class="form-group form-group-default">
                    <div class="form-input-group">
                        <label>Search</label>
                        <input type="search" name="search" placeholder="Search by keywords" class="form-control" value="{{ request()->search }}" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xlg-3">
                <div class="form-group form-group-default input-group">
                    <div class="form-input-group">
                        <label>Items Per Page</label>
                        <select name="per_page" class="form-control">
                            <option value="10" @if(request()->per_page == 10) selected @endif>10 items</option>
                            <option value="25" @if(request()->per_page == 25) selected @endif>25 items</option>
                            <option value="50" @if(request()->per_page == 50) selected @endif>50 items</option>
                            <option value="100" @if(request()->per_page == 100) selected @endif>100 items</option>
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