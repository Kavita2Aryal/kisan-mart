<form action="<?php echo e(url()->current()); ?>" class="search-parent m-b-10">
    <div class="form-group-attached">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-9 col-xlg-9">
                <div class="form-group form-group-default">
                    <div class="form-input-group">
                        <label>Search</label>
                        <input type="search" name="search" placeholder="Search by keywords" class="form-control" value="<?php echo e(request()->search); ?>" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-3 col-xlg-3">
                <div class="form-group form-group-default input-group">
                    <div class="form-input-group">
                        <label>Items Per Page</label>
                        <select name="per_page" class="form-control">
                            <option value="10" <?php if(request()->per_page == 10): ?> selected <?php endif; ?>>10 items</option>
                            <option value="25" <?php if(request()->per_page == 25): ?> selected <?php endif; ?>>25 items</option>
                            <option value="50" <?php if(request()->per_page == 50): ?> selected <?php endif; ?>>50 items</option>
                            <option value="100" <?php if(request()->per_page == 100): ?> selected <?php endif; ?>>100 items</option>
                        </select>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <button type="submit" class="normal btn btn-link btn-lg"><i class="pg-icon">search</i></button>
                        </span>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <a href="<?php echo e(url()->current()); ?>" class="normal btn btn-link btn-lg"><i class="pg-icon">refresh</i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form><?php /**PATH /var/www/kisan-mart/resources/views/includes/pagination_search.blade.php ENDPATH**/ ?>