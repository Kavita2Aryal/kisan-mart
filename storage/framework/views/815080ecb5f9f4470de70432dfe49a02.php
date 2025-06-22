<div class="container-fluid footer">
    <div class="copyright">
        <div>
            <span class="first-line">
                <a href="<?php echo e(config('app.config.system.website')); ?>" class="text-complete" target="_blank">
                    <img src="<?php echo e(asset('assets/img/tc-logo.png')); ?>" alt="logo" width="25" class="m-r-5">
                    <?php echo e(config('app.config.system.name')); ?>

                </a>
                &copy; <?php echo e(now()->year); ?> All Rights Reserved.
            </span>
            <span class="second-line"><?php echo e(config('app.config.system.version')); ?></span>
        </div>
        <div class="clearfix"></div>
    </div>
</div><?php /**PATH /var/www/kisan-mart/resources/views/includes/footer.blade.php ENDPATH**/ ?>