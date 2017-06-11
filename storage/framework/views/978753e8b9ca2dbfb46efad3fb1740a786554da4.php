<?php $__env->startSection('slider'); ?>
	<?php echo $__env->make('home.index.slider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('top-news'); ?>
	<?php echo $__env->make('home.index.top-news', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('home.index.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript_page'); ?>
	<script type="text/javascript">
	$("img.lazy").lazyload({
        effect: "fadeIn"
    });
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.frontend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>