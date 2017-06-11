<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="vi" lang="vi">
<head>
    <title>@yield('title')</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="robots" content="index,follow"/>
  <meta http-equiv="content-language" content="vi"/>
  <meta name="description" content="@yield('site_description')"/>
  <meta name="keywords" content="@yield('site_keywords')"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
  <link rel="shortcut icon" href="@yield('favicon')" type="image/x-icon"/>
  <link rel="canonical" href="{{ url()->current() }}"/>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta property="og:type" content="website"/>
  <meta property="og:image:width" content="650"/>
  <meta property="og:image:height" content="350"/>
  <meta property="og:image:type" content="image/jpeg"/>
  <meta property="og:image" content="{{ $detail->poster_url ? Helper::showImage($detail->poster_url) : Helper::showImage($detail->image_url) }}"/>
  <meta property="article:publisher" content="@yield('google_fanpage')"/>
  <meta property="og:url" content="{{ url()->current() }}"/>
  <meta property="og:title" content="@yield('title')"/>
  <meta property="og:description" content="@yield('site_description')"/>
  <meta property="og:site_name" content="@yield('site_name')"/>
  <meta property="og:updated_time" content="1468757347"/>
  <meta property="fb:app_id" content="@yield('facebook_appid')"/>
  <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ URL::asset('assets/css/main.css?v=5') }}" type="text/css" />
  <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.cluetip.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.qtip.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ URL::asset('assets/css/custom.css?v=1.1') }}" type="text/css" />
  <link rel="stylesheet" href="{{ URL::asset('assets/css/psbar.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ URL::asset('assets/css/star-rating.css') }}" type="text/css" />
  <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-1.9.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.lazyload.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.qtip.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('assets/js/md5.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.cookie.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('assets/js/123movies.min.js?v=2.2') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('assets/js/psbar.jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('assets/js/star-rating.js') }}"></script>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="{{ URL::asset('assets/js/detectmobilebrowser.js') }}"></script>
     
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7&appId={{ env('FACEBOOK_APP_ID') }}";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<!--header-->
<header>
    <div class="container">
        @include('layout.home.header-menu')  @include('layout.home.search') 
        <div class="clearfix"></div>
    </div>
</header>
<!--/header-->

<div class="header-pad"></div>
<div id="main" class="page-detail">
    <div class="container">
        <div class="pad"></div>
        <div class="main-content main-detail">

            @include('home.detail.bread')

            @yield('content')

            <!-- keywords -->
            @if( !empty( $tagSelected ) )
            <?php $countTag = count($tagSelected);            
            ?>
            <div id="mv-keywords">
                <strong>Tags:</strong>
                <?php $i = 0; ?>
                @foreach( $tagSelected as $tag )
                <?php $i++; ?>
                <a target="_blank" href="{{ route('tags', $tag->slug) }}" title="{{ $tag->name }}">
                   <h5>{{ $tag->name }}</h5>
                </a><?php if($i < $countTag) echo ","; ?>
                @endforeach           
            </div>
            @endif
            @if( $detail->content && $is_landing == 1)

            <div class="content-kus" style="background: #fff;">
                <?php echo $detail->content ?>
            </div>
            @endif        
            <div class="pad"></div>
            <!--related-->
            @include('home.detail.related')

        </div>
    </div>
</div>
</div>
<script>
    $('#pop-trailer').on('shown.bs.modal', function () {
        $('#iframe-trailer').attr('src', "https://www.youtube.com/embed/udNhyff-FIU");
    });
    $('#pop-trailer').on('hide.bs.modal', function () {
        $('#iframe-trailer').attr('src', '');
    });
</script>


@include('home.index.footer')   

<script>
    if (!isCookieEnabled()) {
        $('#alert-cookie').css('display', 'block');
        $('body').addClass('off-cookie');
    }
</script>
<script src="{{ URL::asset('assets/js/video.js') }}"></script>

<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js?v=0.1') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap-select.js?v=0.1') }}"></script>

@yield('javascript_page')
<script type="text/javascript">
function report(obj){
    $.ajax({
        url: "{{ route('report') }}",
        type: "POST",             
        data: {
            film_id : obj.data('value'),
            episode_id : obj.data('ep'),
            _token : '{{ csrf_token() }}'
        },
        success : function(){
          $('#report-alert').show();
          obj.hide();
        }
    });
}
function favorite(film_id, status){
    $.ajax({
        url: "{{ route('favorite') }}",
        type: "POST",             
        data: {
            film_id : film_id,
            status : status,
            _token : '{{ csrf_token() }}'
        }
    });
}
$(document).ready(function(){ 
    $('.addFavorite').click(function(){
        var obj = $(this);
        film_id = obj.attr('data-value');
        status = obj.attr('data-status');
        favorite(film_id, status);
        if( status == 0){
            $('#addFavorite').show();
            $('#removeFavorite').hide();
        }else{
            $('#addFavorite').hide();
            $('#removeFavorite').show();
        }
    });     
    $('#btnReport').click(function(){      
      report($(this));      
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
});

</script>
<script type="text/javascript">
   
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

