<?php echo $__env->make('frontend.home.slider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('bcrum'); ?>
<section class="breadcrumb-wrapper visible-md-block visible-lg-block">
   <div class="container">
      <ol class="breadcrumb">
         <li>
            <h1>Free JAVHD, Japanese Porn, Asian Sex Videos - phim18.fun</h1>
         </li>
      </ol>
   </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php foreach($cateList as $cate): ?>    
<div class="container">
   <div class="box">
      <div class="clearfix"></div>
      <h3 class="title"><?php echo $cate->name; ?> <a href="movie.html" title="View more newest movies"><i class="glyphicon glyphicon-chevron-right"></i></a></h3>
      <div class="movie-list">
          <?php foreach($moviesArr[$cate->id] as $vid): ?>
         <div class="col-md-4 col-sm-6">
            <div class="video-item">
               <div class="item-thumbnail">
                  <a href="<?php echo e(route('detail', [ $vid->slug, $vid->id ])); ?>" title="<?php echo $vid->title; ?>" >
                     <img src="<?php echo $vid->image_url; ?>" alt="<?php echo $vid->title; ?>">
                     <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                  </a>
                  <span class="duration"><?php echo e($vid->duration); ?></span>
                  <!--<span class="quality">HD</span>-->
               </div>
               <div class="item-detail">
                  <h4><a href="<?php echo e(route('detail', [ $vid->slug, $vid->id ])); ?>" title="<?php echo $vid->title; ?>"><?php echo $vid->title; ?></a></h4>
                  <p>
                     <!--<span>47 views</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>0 likes</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> -->
                     <span><?php echo date('d-m-Y H:i', strtotime($vid->created_at)); ?></span>
                  </p>
               </div>
            </div>
         </div>                     
         <?php endforeach; ?>
      </div>
      <div class="clearfix"></div>
   </div>
</div>           
<?php endforeach; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>