<?php $__env->startSection('title'); ?> <?php echo e($settingArr['site_title']); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('site_description'); ?> <?php echo e(strip_tags($settingArr['site_description'])); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('site_keywords'); ?> <?php echo e($settingArr['site_keywords']); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('banner'); ?> <?php echo e($settingArr['banner']); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('facebook_appid'); ?> <?php echo e($settingArr['facebook_appid']); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('site_name'); ?> <?php echo e($settingArr['site_name']); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('favicon'); ?><?php echo e(Helper::showImage($settingArr['favicon'])); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('logo'); ?><?php echo e(Helper::showImage($settingArr['logo'])); ?><?php $__env->stopSection(); ?>
<div class="pad"></div>
<div class="movies-list-wrap mlw-latestmovie">
    <div class="ml-title">
        <h2 class="pull-left name">Suggestion <i class="fa fa-chevron-right ml10"></i></h2>
        <ul role="tablist" class="nav nav-tabs" id="ul_tab">
            <li class="active"><a class="loadMovies" href="javascript:void(0)" data-value="most-view" rel="nofollow">Xem nhiều trong ngày</a></li>
            <li><a class="loadMovies" href="javascript:void(0)" data-value="top-imdb" rel="nofollow">Top IMDb</a></li>
            <li><a class="loadMovies" href="javascript:void(0)" data-value="lastest" rel="nofollow">Mới cập nhật</a></li>   
            <?php if(Session::get('login')): ?>
            <li><a class="loadMovies" href="javascript:void(0)" data-value="kho-phim" rel="nofollow">Kho phim của tôi</a></li>
            <?php endif; ?>  
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="movies-list movies-list-full tab-pane in fade active" id="data-suggestion">
         
        <div class="clearfix"></div>
    </div>
</div>
<div class="pad"></div>
<div class="movies-list-wrap mlw-latestmovie">
    <div class="ml-title">
        <h2 class="pull-left name">Phim lẻ mới nhất <i class="fa fa-chevron-right ml10"></i></h2>
        <a href="<?php echo e(route('cate', 'phim-le')); ?>" class="pull-right cat-more">Xem thêm »</a>

        <div class="clearfix"></div>
    </div>
    <div class="movies-list movies-list-full tab-pane in fade active">
         <?php if( $phimLeArr->count() > 0): ?>
             <?php foreach( $phimLeArr as $movies): ?>
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
           <?php endforeach; ?>
          <?php endif; ?>
        <div class="clearfix"></div>
    </div>
</div>
<div class="movies-list-wrap mlw-latestmovie">
    <div class="ml-title">
        <h2 class="pull-left name">Phim bộ mới cập nhật <i class="fa fa-chevron-right ml10"></i></h2>
        <a href="<?php echo e(route('cate', 'phim-bo')); ?>" class="pull-right cat-more">Xem thêm »</a>

        <div class="clearfix"></div>
    </div>
    <div class="movies-list movies-list-full tab-pane in fade active">
         <?php if( $phimBoArr->count() > 0): ?>
             <?php foreach( $phimBoArr as $movies): ?>
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
           <?php endforeach; ?>
          <?php endif; ?>
        <div class="clearfix"></div>
    </div>
</div>
<div class="content-kus" style="text-align: center; margin: 20px 0; padding: 15px;">
</div>
<?php $__env->startSection('javascript_page'); ?>
 <script type="text/javascript">
$(document).ready(function(){ 
$.ajax({
    url: "<?php echo e(route('ajax-tab')); ?>",
    type: "GET",
    async: false,      
    data: {
      type : 'most-view',        
    },
    beforeSend: function() {       
        $('#data-suggestion').html('<p style="text-align:center; padding-top:30px;"><img src="<?php echo e(URL::asset("assets/images/loading.gif")); ?>" alt="loading"></p>');
    },      
    success: function (response) {
      
      $('#data-suggestion').html( response );
      $("img.lazy").lazyload({
          effect: "fadeIn"
      }); 
     
      if (!jQuery.browser.mobile) {
      $('.jt').qtip({
          content: {
              text: function (event, api) {
                  $.ajax({
                      url: api.elements.target.attr('data-url'),
                      type: 'GET',
                      success: function (data, status) {
                          // Process the data

                          // Set the content manually (required!)
                          api.set('content.text', data);
                      }
                  });
              }, // The text to use whilst the AJAX request is loading
              title: function (event, api) {
                  return $(this).attr('title');
              }
          },
          position: {
              my: 'top left',  // Position my top left...
              at: 'top right', // at the bottom right of...
              viewport: $(window),
              effect: false,
              target: 'mouse',
              adjust: {
                  mouse: false  // Can be omitted (e.g. default behaviour),
              },
              show: {
                  effect: false
              }
          },
          hide: {
              fixed: true
          },
          style: {
              classes: 'qtip-light qtip-bootstrap',
              width: 320
          }
      });
  }
    },
    error: function(response){                             
        var errors = response.responseJSON;
        for (var key in errors) {
          
        }             
    }
  });     
      $('.loadMovies').click(function(){        
        var obj = $(this);
        $.ajax({
            url: "<?php echo e(route('ajax-tab')); ?>",
            type: "GET",
            async: false,      
            data: {
              type : obj.attr('data-value'),        
            },
            beforeSend: function() {
                $('#ul_tab li').removeClass('active');
                obj.parent().addClass('active');
                // setting a timeout
                $('#data-suggestion').html('<p style="text-align:center; padding-top:30px;"><img src="<?php echo e(URL::asset("assets/images/loading.gif")); ?>" alt="loading"></p>');
            },      
            success: function (response) {
              
              $('#data-suggestion').html( response );
              $("img.lazy").lazyload({
                  effect: "fadeIn"
              }); 
             
              if (!jQuery.browser.mobile) {
              $('.jt').qtip({
                  content: {
                      text: function (event, api) {
                          $.ajax({
                              url: api.elements.target.attr('data-url'),
                              type: 'GET',
                              success: function (data, status) {
                                  // Process the data

                                  // Set the content manually (required!)
                                  api.set('content.text', data);
                              }
                          });
                      }, // The text to use whilst the AJAX request is loading
                      title: function (event, api) {
                          return $(this).attr('title');
                      }
                  },
                  position: {
                      my: 'top left',  // Position my top left...
                      at: 'top right', // at the bottom right of...
                      viewport: $(window),
                      effect: false,
                      target: 'mouse',
                      adjust: {
                          mouse: false  // Can be omitted (e.g. default behaviour),
                      },
                      show: {
                          effect: false
                      }
                  },
                  hide: {
                      fixed: true
                  },
                  style: {
                      classes: 'qtip-light qtip-bootstrap',
                      width: 320
                  }
              });
          }
            },
            error: function(response){                             
                var errors = response.responseJSON;
                for (var key in errors) {
                  
                }             
            }
          });
      });
    });
 function isCookieEnabled() {
       var e = navigator.cookieEnabled ? !0 : !1;
       return "undefined" != typeof navigator.cookieEnabled || e || (document.cookie = "testcookie", e = -1 != document.cookie.indexOf("testcookie") ? !0 : !1), e
   }
   if (!isCookieEnabled()) {
       $('#alert-cookie').css('display', 'block');
       $('body').addClass('off-cookie');
   }
    if (!jQuery.browser.mobile) {
        $('.jt').qtip({
            content: {
                text: function (event, api) {
                    $.ajax({
                        url: api.elements.target.attr('data-url'),
                        type: 'GET',
                        success: function (data, status) {                           
                            api.set('content.text', data);
                        }
                    });
                }, // The text to use whilst the AJAX request is loading
                title: function (event, api) {
                    return $(this).attr('title');
                }
            },
            position: {
                my: 'top left',  // Position my top left...
                at: 'top right', // at the bottom right of...
                viewport: $(window),
                effect: false,
                target: 'mouse',
                adjust: {
                    mouse: false  // Can be omitted (e.g. default behaviour),
                },
                show: {
                    effect: false
                }
            },
            hide: {
                fixed: true
            },
            style: {
                classes: 'qtip-light qtip-bootstrap',
                width: 320
            }
        });
    }
       
    
</script>
<?php $__env->stopSection(); ?>