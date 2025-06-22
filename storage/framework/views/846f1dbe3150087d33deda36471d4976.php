<script>
<?php if(session('status')): ?>
	<?php if(session('status') == 'two-factor-authentication-enabled'): ?>
		notify_bar('info', "Two factor authentication has been enabled."); 
    <?php elseif(session('status') == 'two-factor-authentication-disabled'): ?>
		notify_bar('info', "Two factor authentication has been disabled.");
	<?php elseif(session('status') == 'profile-information-updated'): ?>
		notify_bar('info', "Your profile has been updated.");
	<?php elseif(session('status') == 'password-updated'): ?>
		notify_bar('info', "Your password has been updated.");
	<?php else: ?>
		notify_bar('info', "<?php echo e(session('status')); ?>");
	<?php endif; ?>
<?php elseif(session('info')): ?>

	notify_bar('info', "<?php echo e(session('info')); ?>");

<?php elseif(session('success')): ?>

	notify_bar('info', "<?php echo e(session('success')); ?>");

<?php elseif(session('warning')): ?>

	notify_bar('warning', "<?php echo e(session('warning')); ?>");

<?php elseif(session('error')): ?>

	notify_bar('danger', "<?php echo e(session('error')); ?>");

<?php elseif(session('info-circle')): ?>

	<?php $info = session('info-circle'); ?>
	notify_circle('info', "<?php echo e($info['title']); ?>", "<?php echo e($info['msg']); ?>", "<?php echo $info['icon']; ?>");

<?php endif; ?>
</script><?php /**PATH /var/www/kisan-mart/resources/views/includes/notify.blade.php ENDPATH**/ ?>