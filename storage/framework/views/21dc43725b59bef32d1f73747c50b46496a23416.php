<div class="header-logo">
   <a title="<?php echo e($settingArr['site_name']); ?>" href="<?php echo e(URL::to('/')); ?>" id="logo"></a>
</div>
<div class="mobile-menu"><i class="fa fa-reorder"></i></div>
<div class="mobile-search"><i class="fa fa-search"></i></div>
<div id="menu">
   <ul class="top-menu">
      <li class="">
         <a href="<?php echo e(URL::to('/')); ?>" title="Trang chủ">Trang chủ</a>
      </li>
     
         <li>
            <a href="<?php echo e(route('cate', 'phim-theo-the-loai')); ?>" title="QUỐC GIA">THỂ LOẠI</a>
            <?php if( !empty($parentCate) ): ?>
            <div class="sub-container" style="display: none">
               <ul class="sub-menu">
                  <?php foreach( $parentCate as $cate ): ?>
                  <li>                    
                     <a href="<?php echo e(route('cate', $cate->slug)); ?>" title="<?php echo e($cate->name); ?>"><?php echo e($cate->name); ?></a>
                  </li>                  
                  <?php endforeach; ?>
               </ul>
               <div class="clearfix"></div>
            </div>
            <?php endif; ?>
         </li>
         <li>
            <a href="<?php echo e(route('cate', 'phim-theo-quoc-gia')); ?>" title="QUỐC GIA">QUỐC GIA</a>
            <?php if( !empty($countryArr) ): ?>
            <div class="sub-container" style="display: none">
               <ul class="sub-menu">
                  <?php foreach( $countryArr as $country ): ?>
                  <li>                    
                     <a href="<?php echo e(route('cate', $country->slug)); ?>" title="<?php echo e($country->name); ?>"><?php echo e($country->name); ?></a>
                  </li>                  
                  <?php endforeach; ?>
               </ul>
               <div class="clearfix"></div>
            </div>
            <?php endif; ?>
         </li> 
     
      <li>
         <a href="<?php echo e(route('news-list')); ?>" title="Tin tức">Tin tức</a>
      </li>      
   </ul>
   <div class="clearfix"></div>
</div>
<!--<div id="top-user"></div>-->