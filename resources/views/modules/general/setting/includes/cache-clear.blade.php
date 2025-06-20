<div class="row">
    <div class="col-xl-4 col-lg-4">
        <h4>Cache Clear</h4>
        <p>Manually clear website cache</p>
    </div>
    <div class="col-xl-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <h6>This feature is used to manually clear website's cache.</h6>
                <p>When clicked on this button, the website cache will be cleard.</p>
                <form method="get" action="{{ route('cache.clear') }}">
                    <div class="form-group m-b-0">
                        <button class="btn btn-link btn-link-fix text-danger p-l-10 p-r-10" type="submit">
                            CLEAR <span class="visible-x-inline m-l-5">WEBSITE CACHE</span>
                        </button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>