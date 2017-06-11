<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi">
   <head>
      <title>@yield('title')</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
      <meta name="robots" content="index,follow"/>
      <meta http-equiv="content-language" content="en"/>
      <meta name="description" content="@yield('site_description')"/>
      <meta name="keywords" content="@yield('site_keywords')"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
      <link rel="shortcut icon" href="@yield('favicon')" type="image/x-icon"/>
      <link rel="canonical" href=""/>
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <meta property="og:type" content="website"/>
      <meta property="og:image:width" content="650"/>
      <meta property="og:image:height" content="350"/>
      <meta property="og:image:type" content="image/jpeg"/>
      <meta property="og:image" content="@yield('banner')"/>
      <meta property="article:publisher" content="@yield('google_fanpage')"/>
      <meta property="og:url" content=""/>
      <meta property="og:title" content="@yield('title')"/>
      <meta property="og:description" content="@yield('site_description')"/>
      <meta property="og:site_name" content="@yield('site_name')"/>
      <meta property="og:updated_time" content="1468757347"/>
      <meta property="fb:app_id" content="@yield('facebook_appid')"/>
      <script>
         var base_url = 'http://' + document.domain + '/';
      </script>
       <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/css/main.css?v=5') }}" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.cluetip.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.qtip.min.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/css/custom.css?v=1.1') }}" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/css/slide.css') }}" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('assets/css/psbar.css') }}" type="text/css" />
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-1.9.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.lazyload.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.qtip.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/md5.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.cookie.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/123movies.min.js?v=2.2') }}"></script>
   <script src="https://apis.google.com/js/platform.js" async defer></script>


    <script src="{{ URL::asset('assets/js/detectmobilebrowser.js') }}"></script>
   </head>
   <body>
      @if( \Request::route()->getName() == "news-detail")
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7&appId=1429139510434147";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
      <style type="text/css">
          .fb-comments, .fb-comments iframe[style], .fb-like-box, .fb-like-box iframe[style], .fb-comments span, .fb-comments iframe span[style], .fb-like-box span, .fb-like-box iframe span[style] 
{
       width: 100% !important;
}

      </style>
      @endif     
      
      <!--header-->
      <header>
         <div class="container">
            @include('layout.home.header-menu')
            @include('layout.home.search')
            <div class="clearfix"></div>
         </div>
      </header>
      <script type="text/javascript">
         var hidden = true;
         $('.search-suggest').mouseover(function () {
             hidden = false;
         });
         
         $('.search-suggest').mouseout(function () {
             hidden = true;
         });
         
         $('input[name=keyword]').keyup(function () {
             var keyword = $(this).val();
             if (keyword.trim().length > 2) {
                 $.ajax({
                     url: base_url + 'ajax/suggest_search',
                     type: 'POST',
                     dataType: 'json',
                     data: {keyword: keyword},
                     success: function (data) {
                         $('.search-suggest').html(data.content);
                         if (data.content.trim() !== '') {
                             $('.search-suggest').show();
                         } else {
                             $('.search-suggest').hide();
                         }
                     }
                 })
             } else {
                 $('.search-suggest').hide();
             }
         });
         $('input[name=keyword]').blur(function () {
             if (hidden) {
                 $('.search-suggest').hide();
             }
         });
         $('input[name=keyword]').focus(function () {
             if ($('.search-suggest').html() !== '') {
                 $('.search-suggest').show();
             }
         });
         
         $('input[name=keyword]').keypress(function (event) {
             if (event.which == 13) {
                 searchMovie();
             }
         });
         
         function searchMovie() {
             var keyword = $('input[name=keyword]').val();
             if (keyword.trim() !== '') {
                 keyword = keyword.replace(/(<([^>]+)>)/ig, "").replace(/[`~!@#$%^&*()_|\=?;:'",.<>\{\}\[\]\\\/]/gi, "");
                 keyword = keyword.split(" ").join("+");
                 window.location.href = base_url + 'movie/search/' + keyword;
             }
         }
      </script>
      <!--/header-->
      <div class="header-pad"></div>
      <!-- main -->
      <div id="main" class="{{ $page_name }}">
         <div class="container">
            @if( $page_name == "")
            <div class="top-content">
               <!-- slider -->
                @yield('slider')
               <!--/slider -->
               <!--top news-->
               @yield('top-news')
               <!--/top news-->
               <div class="clearfix"></div>
            </div>
            <!--social home-->
            <div class="social-home">
               <div class="sh-like">
                  <div class="fb-like" data-href="http://facebook.com/phim1p.com" data-layout="button_count"
                     data-action="like" data-show-faces="true" data-share="false"></div>
               </div>
               <div class="addthis_native_toolbox"></div>
               <span class="sh-text">Like and Share our website to support us.</span>
               <div class="clearfix"></div>
            </div>
            @else
            <div class="pad"></div>
            @endif                      
            <div class="main-content {{ $layout_name }}">
            	@yield('content')               
            </div><!--end main-content-->            
         </div>
      </div>
      <!--/main -->      
      @include('home.index.footer')
      <!-- Modal -->
      <div class="modal fade modal-cuz" id="pop-login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                     class="fa fa-close"></i>
                  </button>                  
               </div>
               <div class="modal-body">
                  <p style="text-align:center">
                  <img src="{{ URL::asset('assets/images/fblogin.png') }}" width="350"  />                     
                  </p>
               </div>               
            </div>
         </div>
      </div>        
      <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js?v=0.1') }}"></script>
      <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap-select.js?v=0.1') }}"></script>
      <script type="text/javascript" src="{{ URL::asset('assets/js/slide.min.js') }}"></script>
      <script type="text/javascript" src="{{ URL::asset('assets/js/psbar.jquery.min.js') }}"></script>
    @yield('javascript_page')
    <script>
      $("img.lazy").lazyload({
          effect: "fadeIn"
      });
        var swiper = new Swiper('#slider', {
            pagination: '.swiper-pagination',
            paginationClickable: true,
            loop: true,
            autoplay: 4000
        });

        $(function () {
            $('.tn-news, .tn-notice').perfectScrollbar();
        });
    </script>

<script type="text/javascript">
    $(document).ready(function () {
        if (window.top !== window.self) {
            document.head.innerHTML = '';
            document.body.innerHTML = '';
        }
        if (!$.cookie('domain-alert')) {
            $.cookie('domain-alert', 1, {expires: 1, path: '/'});
            $('.alert-bottom').css('display', 'block');
            setInterval(function () {
                $(".alert-bottom").remove();
            }, 15000);
        }
        $('#alert-bottom-close').click(function () {
            $(".alert-bottom").remove();
        });
    });
  window.fbAsyncInit = function() {
  FB.init({
    appId      : $('#fb-app-id').val(),
    cookie     : true,  // enable cookies to allow the server to access
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.7' // use graph api version 2.7
  });
  
};

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$(document).ready(function() {
  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $('.login-by-facebook-popup').click(function() {
    FB.login(function(response){
      if(response.status == "connected")
      {
         // call ajax to send data to server and do process login
        var token = response.authResponse.accessToken;
        $.ajax({
          url: $('#route-ajax-login-fb').val(),
          method: "POST",
          data : {
            token : token
          },
          success : function(data){
            
            location.reload();
            
          }
        });

      }
    }, {scope: 'public_profile,email'});
  });
});
</script>
<input type="hidden" id="route-ajax-login-fb" value="{{ route('ajax-login-by-fb') }}">
<input type="hidden" id="fb-app-id" value="{{ env('FACEBOOK_APP_ID') }}">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '{{ $settingArr['google_analystic'] }}', 'auto');
  ga('send', 'pageview');

</script>
   </body>
</html>