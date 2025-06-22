<div class="card" style="position: relative;">
    <div class="card-body scroll-ing" id="send-section">
        <a href="javascript:void(0);" class="btn btn-link btn-link-fix btn-lg btn-filter-section">
            <i class="pg-icon">settings</i>
        </a>
        <div class="section-container">
            <?php if($headers != null): ?>
            <?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hkey => $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="header-item content-item" style="display: none;">
                <div>
                    <img src="<?php echo e(url('storage/cms/header/'.$header)); ?>" class="full-width" data-tippy-content="Header <?php echo e($hkey); ?>" data-tippy-placement="top-end">
                </div>
                <div class="content-tools">
                    <input type="hidden" name="header" value="<?php echo e($hkey); ?>">
                    <a href="javascript:void(0);" class="normal btn btn-link text-danger btn-remove"><i class="pg-icon">close_lg</i></a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <?php if($footers != null): ?>
            <?php $__currentLoopData = $footers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fkey => $footer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="footer-item content-item" style="display: none;">
                <div>
                    <img src="<?php echo e(url('storage/cms/footer/'.$footer)); ?>" class="full-width" data-tippy-content="Footer <?php echo e($fkey); ?>" data-tippy-placement="top-end">
                </div>
                <div class="content-tools">
                    <input type="hidden" name="footer" value="<?php echo e($fkey); ?>">
                    <a href="javascript:void(0);" class="normal btn btn-link text-danger btn-remove"><i class="pg-icon">close_lg</i></a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <?php if($sections != null): ?>
            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php 
            $filter_options = array_filter($section['config'], function ($conf) { return $conf == 1; }); 
            $filter_class = 'has-'.join(' has-', array_keys($filter_options)); 
            ?>
            <div class="section-item section-item-<?php echo e($section['index']); ?> content-item <?php echo e($filter_class); ?>">
                <div>
                    <img src="<?php echo e(secure_img_section($section['filename'], '768')); ?>" class="full-width" data-tippy-content="Section <?php echo e($section['index']); ?>" data-tippy-placement="top-end">
                </div>
                <div class="content-tools">
                    <input type="hidden" class="section-index" name="sections[not_set][index]" value="<?php echo e($section['index']); ?>">
                    <input type="hidden" class="section-order" name="sections[not_set][display_order]" value="">
                    <a href="javascript:void(0);" class="normal btn btn-link text-danger btn-remove"><i class="pg-icon">close_lg</i></a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
    
    <div id="filter-section" class="scroll-ing" style="display: none;">
        <div class="row">
            <div class="col-sm-12">
                <p class="m-b-15">
                    <strong>SHOW ALL</strong>
                    <a href="javascript:void(0);" class="normal btn btn-link btn-filter-section-close pull-right" style="display: none;">
                        <i class="pg-icon">close_lg</i>
                    </a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="javascript:void(0);" class="normal btn btn-link">
                    <div class="form-check info m-t-0 m-b-0">
                        <input type="checkbox" class="filter-all-item" id="filter-all-header" value="header">
                        <label for="filter-all-header"><strong>HEADERS</strong></label>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="javascript:void(0);" class="normal btn btn-link">
                    <div class="form-check info m-t-0 m-b-0">
                        <input type="checkbox" class="filter-all-item" id="filter-all-footer" value="footer">
                        <label for="filter-all-footer"><strong>FOOTERS</strong></label>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <a href="javascript:void(0);" class="normal btn btn-link">
                    <div class="form-check info m-t-0 m-b-0">
                        <input type="checkbox" class="filter-all-item" id="filter-all-section" value="section" checked>
                        <label for="filter-all-section"><strong>SECTIONS</strong></label>
                    </div>
                </a>
            </div>
        </div>
        <hr class="m-t-20 m-b-20">
        <div class="row">
            <div class="col-sm-12">
                <p class="m-b-15"><strong>MUST HAVE</strong></p>
            </div>
        </div>
        <div class="row">
            <?php if($filters != null): ?>
            <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter_key => $filter_text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6">
                <a href="javascript:void(0);" class="normal btn btn-link">
                    <div class="form-check info m-t-0 m-b-0">
                        <input type="checkbox" class="filter-item" id="filter-<?php echo e(substr($filter_key, 5)); ?>" value="<?php echo e($filter_key); ?>" checked>
                        <label for="filter-<?php echo e(substr($filter_key, 5)); ?>"><strong class="text-uppercase"><?php echo e($filter_text); ?></strong></label>
                    </div>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        <?php if($layouts): ?>
        <hr class="m-t-20 m-b-20">
        <div class="row">
            <div class="col-sm-12">
                <p class="m-b-15"><strong>SAVED LAYOUT</strong></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php $__currentLoopData = $layouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="m-b-10 use-page-layout-parent">
                    <a href="javascript:void(0);" class="text-capitalize btn-use-page-lagout"><?php echo e($layout['name']); ?></a>
                    <input type="hidden" class="use-page-layout" value="<?php echo e($layout['sections']); ?>">
                    <form action="<?php echo e(route('page.layout.config.destroy', [$layout['uuid']])); ?>" method="POST" class="inline pull-right"> 
                        <?php echo method_field('DELETE'); ?> <?php echo csrf_field(); ?>
                        <button class="btn btn-xs btn-ignore-loading" type="submit">
                            <i class="pg-icon">trash_alt</i>
                        </button>
                    </form>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div><?php /**PATH /var/www/kisan-mart/resources/views/modules/cms/page/includes/send_section.blade.php ENDPATH**/ ?>