<div id="slider">
  <div class="swiper-wrapper">
    <?php if( $hotArr->count() > 0): ?>
    
      <?php foreach( $hotArr as $movies): ?>
      
      
       <div class="swiper-slide" style="background-image: url(<?php echo e(Helper::showImage( $movies->poster_url )); ?>);">
          <a href="<?php echo e(route('landing', $movies->slug)); ?>"
             class="slide-link"
             title="<?php echo e($movies->title); ?>"></a>
          <span class="slide-caption">
             <h2><?php echo e($movies->title); ?></h2>
             <p class="sc-desc"><?php echo e($movies->description); ?></p>
             <div class="slide-caption-info">
                <div class="block"><strong>Thể loại:</strong>
                
                     <?php $i = 0; 
                     $filmCategory = $movies->filmCategoryName($movies->id);
                      $countCategory = count($filmCategory);
                     ?>
                      <?php if( !empty( $filmCategory ) ): ?>
                        <?php foreach( $filmCategory as $category): ?>  
                        <?php $i++; 
                        ?>                
                        
                        <a href="<?php echo e(route('cate', $category['slug'])); ?>" title="<?php echo e($category['name']); ?>"><?php echo e($category['name']); ?></a>                         
                        <?php echo e($i < $countCategory ? ", " : ""); ?>

                      
                      <?php endforeach; ?>
                    <?php endif; ?>
                  
                 
                </div>
                <div class="block"><strong>Quốc gia:</strong>
                    
                     <?php $i = 0; 
                     $filmCountry = $movies->filmCountryName($movies->id);
                      $countCountry = count($filmCountry);
                     ?>
                      <?php if( !empty( $filmCountry ) ): ?>
                        <?php foreach( $filmCountry as $country): ?>  
                        <?php $i++; 
                        ?>                
                        
                        <a href="<?php echo e(route('cate', $country['slug'])); ?>" title="<?php echo e($country['name']); ?>"><?php echo e($country['name']); ?></a>                         
                        <?php echo e($i < $countCountry ? ", " : ""); ?>

                      
                      <?php endforeach; ?>
                    <?php endif; ?>
                  
                  
                </div>
                <?php if( $movies->duration ): ?>
                <div class="block"><strong>Thời lượng:</strong> <?php echo e($movies->duration); ?></div>
                <?php endif; ?>
                <div class="block"><strong>Chất lượng:</strong><?php echo e(Helper::showQuality($movies->quality)); ?>

                </div>
                <?php if(  $movies->release_year ): ?>
                <div class="block"><strong>Release:</strong> <?php echo e($movies->release_year); ?></div>
                <?php endif; ?>
                <?php if(  $movies->imdb ): ?>
                <div class="block"><strong>IMDB:</strong> <?php echo e($movies->imdb); ?></div>                
                <?php endif; ?>
             </div>
           
                <a onclick="location.href='<?php echo e(route("landing", $movies->slug)); ?>'" title=""class="btn btn-success mt20">Xem phim</a>
             
          </span>
          <h2 class="hidden-md title-mod"><?php echo e($movies->title); ?></h2>
       </div>       
      <?php endforeach; ?>    
     <?php endif; ?>
  </div>
  <div class="swiper-pagination"></div>
  <div class="clearfix"></div>
</div>