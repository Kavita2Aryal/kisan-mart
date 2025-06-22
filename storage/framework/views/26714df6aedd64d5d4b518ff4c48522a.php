<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e(config('app.config.system.name')); ?></title>

    <link href="<?php echo e(asset('assets/img/tc-logo.ico')); ?>" rel="icon" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/bootstrap/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.css')); ?>" rel="stylesheet" type="text/css" media="screen" />

    <?php echo $__env->yieldPushContent('styles'); ?>

    <link href="<?php echo e(asset('assets/css/thunder.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/app.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/grid-nav.min.css')); ?>" rel="stylesheet" type="text/css" />

</head>

<body class="fixed-header">

    <div class="page-container">

        <?php echo $__env->make('includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="page-content-wrapper">

            <div class="content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>

            <?php echo $__env->make('includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>

    </div>

    <?php echo $__env->make('includes.navigation_grid', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script src="<?php echo e(asset('assets/plugins/pace/pace.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery/jquery-3.2.1.min.js')); ?>" type="text/javascript"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="<?php echo e(asset('assets/plugins/modernizr.custom.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/popper/umd/popper.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap/bootstrap.min.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery/jquery-easy.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-actual/jquery.actual.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/tippy/index.all.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/notify.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/thunder.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/app.min.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('scripts'); ?>

    <?php echo $__env->make('includes.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html><?php /**PATH /var/www/kisan-mart/resources/views/layouts/app.blade.php ENDPATH**/ ?>