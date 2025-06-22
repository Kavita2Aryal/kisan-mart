<?php $__env->startSection('title', 'Pages'); ?>

<?php $__env->startSection('content'); ?>
<?php
$website_domain = get_setting('website-domain');
$add_page = config('app.config.cms_page_add') == 'YES' ? true : false;
$mini_page = config('app.config.cms_page_type') == 'MINI' ? true : false;
?>
<div class="container-fluid">
    <div class="row m-t-30">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <?php echo $__env->make('includes.pagination_search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card m-b-15">
                <div class="card-header">
                    <div class="card-title full-width">
                        <div>
                            Pages (<?php echo e($pages->total()); ?>)
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page.create')): ?>
                            <?php if($add_page): ?>
                            <?php if($mini_page): ?>
                            <a href="<?php echo e(route('page.mini.create')); ?>" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">PAGE</span>
                            </a>
                            <?php else: ?>
                            <a href="<?php echo e(route('page.layout.create')); ?>" class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-r-5">
                                <i class="pg-icon m-r-5">plus</i> ADD <span class="visible-x-inline m-l-5">PAGE</span>
                            </a>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-responsive-block">
                        <thead>
                            <tr>
                                <th width="25">#</th>
                                <th>Page</th>
                                <th>URL / Alias</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Last Updated At</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody data-title="Page">
                            <?php if($pages->count() > 0): ?>
                            <?php $i = ($pages->currentPage() - 1) * $pages->perPage(); ?>
                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $i++; ?>
                            <tr>
                                <td><?php echo e($i); ?></td>
                                <td><?php if($pg->is_home == 10): ?> <i class="pg-icon m-r-5">home</i> <?php endif; ?> <?php echo e($pg->name); ?></td>
                                <td>
                                    <a href="<?php echo e(($pg->is_home == 10) ? $website_domain : $website_domain . $pg->alias->alias); ?>" target="_blank"><?php echo e(($pg->is_home == 10) ? $website_domain : $website_domain . $pg->alias->alias); ?></a>
                                </td>
                                <td class="change-status">
                                    <?php if($pg->is_active == 10): ?>
                                    <strong class="text-success">PUBLISHED<strong>
                                            <?php else: ?>
                                            <strong class="text-danger">UNPUBLISHED<strong>
                                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($pg->user->name); ?></td>
                                <td><?php echo e($pg->updated_at); ?></td>
                                <td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page.update')): ?>
                                    <a href="<?php echo e(route('page.edit', [$pg->uuid])); ?>" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success">
                                        <i class="pg-icon m-r-5">pencil</i> EDIT
                                    </a>
                                    <?php if(!$mini_page): ?>
                                    <a href="<?php echo e(route('page.layout.edit', [$pg->uuid])); ?>" class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-success">
                                        <i class="pg-icon m-r-5">pencil</i> EDIT LAYOUT
                                    </a>
                                    <?php endif; ?>
                                    <?php if($pg->is_home == 0): ?>
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-complete btn-change-status" data-url="<?php echo e(route('page.change.status', [$pg->uuid])); ?>" type="button">
                                        <i class="pg-icon m-r-5">tick</i><span><?php echo e($pg->is_active == 10 ? 'UNPUBLISH' : 'PUBLISH'); ?></span>
                                    </button>
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-info btn-change-home" data-form="<?php echo e($i); ?>" type="button">
                                        <i class="pg-icon m-r-5">home</i><span>MARK HOME</span>
                                    </button>
                                    <form class="home-form-<?php echo e($i); ?>" action="<?php echo e(route('page.change.home', [$pg->uuid])); ?>" method="POST" style="display: none;"> <?php echo method_field('PUT'); ?> <?php echo csrf_field(); ?> </form>
                                    <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page.delete')): ?>
                                    <?php if($pg->is_home == 0): ?>
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 m-b-5 text-danger btn-delete" data-form="<?php echo e($i); ?>" type="button">
                                        <i class="pg-icon m-r-5">close_lg</i> DELETE
                                    </button>
                                    <form class="delete-form-<?php echo e($i); ?>" action="<?php echo e(route('page.destroy', [$pg->uuid])); ?>" method="POST" style="display: none;"> <?php echo method_field('DELETE'); ?> <?php echo csrf_field(); ?> </form>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="7">No data to display</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php echo $__env->make('includes.pagination', ['page' => $pages], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/button.all.min.js')); ?>" type="text/javascript"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/kisan-mart/resources/views/modules/cms/page/index.blade.php ENDPATH**/ ?>