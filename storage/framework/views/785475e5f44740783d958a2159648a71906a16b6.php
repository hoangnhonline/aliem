<?php if( $arr->count() > 0): ?>
   <?php foreach( $arr as $movies): ?>    
    <?php if($movies->type == 1): ?>
    <div data-movie-id="<?php echo e($movies->id); ?>" class="ml-item">
        <a href="<?php echo e(route('landing', $movies->slug)); ?>"
           data-url="<?php echo e(route('movies-info', [ $movies->id ])); ?>"
           class="ml-mask jt"
           title="<?php echo e($movies->title); ?>">
              <span class="mli-quality">
                <?php echo e(Helper::showQuality($movies->quality)); ?>                        
              </span>
              <img data-original="<?php echo e(Helper::showImage( $movies->image_url )); ?>" title="<?php echo e($movies->title); ?>" class="lazy thumb mli-thumb"
                 alt="<?php echo e($movies->title); ?>">
              <span class="mli-info">
                 <p class="title"><?php echo e($movies->title); ?></p>
              </span>
        </a>
    </div>
    <?php endif; ?>
    <?php if($movies->type == 2): ?>
    <div data-movie-id="<?php echo e($movies->id); ?>" class="ml-item">
        <a href="<?php echo e(route('landing', $movies->slug)); ?>"
           data-url="<?php echo e(route('movies-info', [ $movies->id ])); ?>"
           class="ml-mask jt"
           title="<?php echo e($movies->title); ?>">
              <?php if(isset($arrEpisode[$movies->id])): ?>
              <?php 
              $tmp = explode(" ", $arrEpisode[$movies->id]);
              ?>
              <span class="mli-eps">
              <?php echo e($tmp[0]); ?> <i><?php echo e(isset($tmp[1]) ? $tmp[1] : ""); ?><?php echo e($movies->duration ? "/".$movies->duration : ""); ?></i>
              </span>
              <?php endif; ?>
              <img data-original="<?php echo e(Helper::showImage( $movies->image_url )); ?>" title="<?php echo e($movies->title); ?>" class="lazy thumb mli-thumb"
                 alt="<?php echo e($movies->title); ?>">
              <span class="mli-info">
                 <p class="title"><?php echo e($movies->title); ?></p>
              </span>
        </a>
    </div>
    <?php endif; ?>  
 <?php endforeach; ?>
<?php else: ?>
  <p style="text-align:center; padding-top:30px;color:#79C142">Đang cập nhật dữ liệu.</p>
<?php endif; ?>