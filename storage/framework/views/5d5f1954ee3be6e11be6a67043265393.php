<?php $__env->startSection('title', 'Create Page'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid page-management">
    <div class="row m-t-20">
        <div class="col-sm-12 col-md-4 col-lg-4 col-xlg-3">
            <?php echo $__env->make('modules.cms.page.includes.send_section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8 col-xlg-9">
            <form role="form" method="POST" action="<?php echo e(route('page.layout.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="card">
                    <div class="card-header">
                        <div class="card-title full-width">
                            <div class="row">
                                <div class="col-md-4 col-lg-2">
                                    <input type="range" id="zoomer" min="50" max="100" value="60" data-orientation="horizontal">
                                </div>
                                <div class="col-md-8 col-lg-10">
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-l-5 btn-save-layout-1" type="button">SAVE LAYOUT</button>
                                    <button class="btn btn-link btn-link-fix p-l-10 p-r-10 pull-right m-l-5 btn-submit" type="submit" data-type="add">CREATE PAGE</button>
                                    <a href="<?php echo e(route('page.index')); ?>" class="normal btn btn-link pull-right" data-tippy-content="Go Back" data-tippy-placement="left"><i class="pg-icon">arrow_left</i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body scroll-ing" id="receive-section">
                        <div class="section-container">
                            <?php if($temp_layout): ?>
                                <?php if($temp_layout['header'] > 0 && $headers != null): ?>
                                <?php $header = $headers[$temp_layout['header']]; ?>
                                <div class="header-item content-item">
                                    <div>
                                        <img src="<?php echo e(url('storage/cms/header/'.$header)); ?>" class="full-width" data-tippy-content="Header <?php echo e($temp_layout['header']); ?>" data-tippy-placement="top-end">
                                    </div>
                                    <div class="content-tools">
                                        <input type="hidden" name="header" value="<?php echo e($temp_layout['header']); ?>">
                                        <a href="javascript:void(0);" class="normal btn btn-link text-danger btn-remove"><i class="pg-icon">close_lg</i></a>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <div class="text-center section-container-info" <?php if(count($temp_layout['sections']) > 0): ?> style="display: none;" <?php endif; ?>>
                                    <p class="text-uppercase hint-text m-t-25 m-b-25">drag & drop sections</p>
                                </div>

                                <?php if($sections != null): ?>
                                <?php $__currentLoopData = $temp_layout['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $section = $sections[$sec['index']]; $index = indexing(); ?>
                                <div class="section-item content-item">
                                    <div>
                                        <img src="<?php echo e(secure_img_section($section['filename'], '768')); ?>" class="full-width" data-tippy-content="Section <?php echo e($section['index']); ?>" data-tippy-placement="top-end">
                                    </div>
                                    <div class="content-tools">
                                        <input type="hidden" class="section-index" name="sections[<?php echo e($index); ?>][index]" value="<?php echo e($sec['index']); ?>">
                                        <input type="hidden" class="section-order" name="sections[<?php echo e($index); ?>][display_order]" value="<?php echo e($sec['display_order']); ?>">
                                        <a href="javascript:void(0);" class="normal btn btn-link text-danger btn-remove"><i class="pg-icon">close_lg</i></a>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                                <?php if($temp_layout['footer'] > 0 && $footers != null): ?>
                                <?php $footer = $footers[$temp_layout['footer']]; ?>
                                <div class="footer-item content-item">
                                    <div>
                                        <img src="<?php echo e(url('storage/cms/footer/'.$footer)); ?>" class="full-width" data-tippy-content="Footer <?php echo e($temp_layout['footer']); ?>" data-tippy-placement="top-end">
                                    </div>
                                    <div class="content-tools">
                                        <input type="hidden" name="footer" value="<?php echo e($temp_layout['footer']); ?>">
                                        <a href="javascript:void(0);" class="normal btn btn-link text-danger btn-remove"><i class="pg-icon">close_lg</i></a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo $__env->make('modules.cms.page.includes.modal_save_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/rangeslider/rangeslider.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/rangeslider/rangeslider.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/Sortable/Sortable.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/page.layout.min.js')); ?>" type="text/javascript"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/kisan-mart/resources/views/modules/cms/page/create_layout.blade.php ENDPATH**/ ?>