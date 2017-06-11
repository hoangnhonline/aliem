@section('title') {{ $settingArr['site_title'] }} @endsection
@section('site_description') {{ strip_tags($settingArr['site_description']) }} @endsection
@section('site_keywords') {{ $settingArr['site_keywords'] }} @endsection
@section('banner') {{ $settingArr['banner'] }} @endsection
@section('facebook_appid') {{ $settingArr['facebook_appid'] }} @endsection
@section('site_name') {{ $settingArr['site_name'] }} @endsection
@section('favicon'){{ Helper::showImage($settingArr['favicon']) }}@endsection
@section('logo'){{ Helper::showImage($settingArr['logo']) }}@endsection
<div class="pad"></div>
<div class="movies-list-wrap mlw-latestmovie">
    <div class="ml-title">
        <h2 class="pull-left name">Suggestion <i class="fa fa-chevron-right ml10"></i></h2>
        <ul role="tablist" class="nav nav-tabs" id="ul_tab">
            <li class="active"><a class="loadMovies" href="javascript:void(0)" data-value="most-view" rel="nofollow">Xem nhiều trong ngày</a></li>
            <li><a class="loadMovies" href="javascript:void(0)" data-value="top-imdb" rel="nofollow">Top IMDb</a></li>
            <li><a class="loadMovies" href="javascript:void(0)" data-value="lastest" rel="nofollow">Mới cập nhật</a></li>   
            @if(Session::get('login'))
            <li><a class="loadMovies" href="javascript:void(0)" data-value="kho-phim" rel="nofollow">Kho phim của tôi</a></li>
            @endif  
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
        <a href="{{ route('cate', 'phim-le') }}" class="pull-right cat-more">Xem thêm »</a>

        <div class="clearfix"></div>
    </div>
    <div class="movies-list movies-list-full tab-pane in fade active">
         @if( $phimLeArr->count() > 0)
             @foreach( $phimLeArr as $movies)
             <div data-movie-id="{{ $movies->id }}" class="ml-item">
                <a href="{{ route('landing', $movies->slug) }}"
                   data-url="{{ route('movies-info', [ $movies->id ]) }}"
                   class="ml-mask jt"
                   title="{{ $movies->title }}">
                      <span class="mli-quality">
                        {{ Helper::showQuality($movies->quality) }}                        
                      </span>
                      <img data-original="{{ Helper::showImage( $movies->image_url )}}" title="{{ $movies->title }}" class="lazy thumb mli-thumb"
                         alt="{{ $movies->title }}">
                      <span class="mli-info">
                         <p class="title">{{ $movies->title }}</p>
                      </span>
                </a>
            </div>
           @endforeach
          @endif
        <div class="clearfix"></div>
    </div>
</div>
<div class="movies-list-wrap mlw-latestmovie">
    <div class="ml-title">
        <h2 class="pull-left name">Phim bộ mới cập nhật <i class="fa fa-chevron-right ml10"></i></h2>
        <a href="{{ route('cate', 'phim-bo') }}" class="pull-right cat-more">Xem thêm »</a>

        <div class="clearfix"></div>
    </div>
    <div class="movies-list movies-list-full tab-pane in fade active">
         @if( $phimBoArr->count() > 0)
             @foreach( $phimBoArr as $movies)
             <div data-movie-id="{{ $movies->id }}" class="ml-item">
                <a href="{{ route('landing', $movies->slug) }}"
                   data-url="{{ route('movies-info', [ $movies->id ]) }}"
                   class="ml-mask jt"
                   title="{{ $movies->title }}">
                  @if(isset($arrEpisode[$movies->id]))
                  <?php 
                  $tmp = explode(" ", $arrEpisode[$movies->id]);
                  ?>
                  <span class="mli-eps">
                  {{ $tmp[0] }} <i>{{ isset($tmp[1]) ? $tmp[1] : "" }}{{ $movies->duration ? "/".$movies->duration : "" }}</i>
                  </span>
                  @endif
                  <img data-original="{{ Helper::showImage( $movies->image_url )}}" title="{{ $movies->title }}" class="lazy thumb mli-thumb"
                     alt="{{ $movies->title }}">
                  <span class="mli-info">
                     <p class="title">{{ $movies->title }}</p>
                  </span>
                </a>
            </div>
           @endforeach
          @endif
        <div class="clearfix"></div>
    </div>
</div>
<div class="content-kus" style="text-align: center; margin: 20px 0; padding: 15px;">
</div>
@section('javascript_page')
 <script type="text/javascript">
$(document).ready(function(){ 
$.ajax({
    url: "{{ route('ajax-tab') }}",
    type: "GET",
    async: false,      
    data: {
      type : 'most-view',        
    },
    beforeSend: function() {       
        $('#data-suggestion').html('<p style="text-align:center; padding-top:30px;"><img src="{{ URL::asset("assets/images/loading.gif") }}" alt="loading"></p>');
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
            url: "{{ route('ajax-tab') }}",
            type: "GET",
            async: false,      
            data: {
              type : obj.attr('data-value'),        
            },
            beforeSend: function() {
                $('#ul_tab li').removeClass('active');
                obj.parent().addClass('active');
                // setting a timeout
                $('#data-suggestion').html('<p style="text-align:center; padding-top:30px;"><img src="{{ URL::asset("assets/images/loading.gif") }}" alt="loading"></p>');
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
@endsection