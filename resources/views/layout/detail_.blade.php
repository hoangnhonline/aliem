<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

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
    <link rel="stylesheet" href="{{ URL::asset('assets/css/psbar.css') }}" type="text/css" />
    <!--<link rel="stylesheet" href="{{ URL::asset('assets/css/star-rating.css') }}" type="text/css" />-->
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-1.9.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.lazyload.js') }}"></script>
    <!--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.qtip.min.js') }}"></script>-->
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.cookie.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/123film.min.js?v=2') }}"></script>
    <!--<script type="text/javascript" src="{{ URL::asset('assets/js/user.min.js?v=1.1') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/md5.min.js') }}"></script>
    <!--<script type="text/javascript" src="{{ URL::asset('assets/js/jwplayer-7.3.6/jwplayer.js') }}"></script>-->
    <script type="text/javascript" src="{{ URL::asset('assets/js/psbar.jquery.min.js') }}"></script>
    <!--<script type="text/javascript" src="{{ URL::asset('assets/js/star-rating.js') }}"></script>-->
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.smooth-scroll.min.js') }}"></script>

    <script src="https://apis.google.com/js/platform.js" async defer></script>


    <script src="{{ URL::asset('assets/js/detectmobilebrowser.js') }}"></script>   
</head>

<body>

    <script type="text/javascript">        
        /*window.fbAsyncInit = function () {
            FB.init({
                appId: '727243164041505',
                cookie: true,  // enable cookies to allow the server to access
                               // the session
                xfbml: true,  // parse social plugins on this page
                version: 'v2.6' // use graph api version 2.6
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));  
        */      
    </script>



    <!--header-->
    <header>
        <div class="container">
            @include('layout.home.header-menu') @include('layout.home.search')
            <div class="clearfix"></div>
        </div>
    </header>
    <script type="text/javascript">
        var hidden = true;
        $('.search-suggest').mouseover(function() {
            hidden = false;
        });

        $('.search-suggest').mouseout(function() {
            hidden = true;
        });

        $('input[name=keyword]').keyup(function() {
            var keyword = $(this).val();
            if (keyword.trim().length > 2) {
                $.ajax({
                    url: base_url + 'ajax/suggest_search',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        keyword: keyword
                    },
                    success: function(data) {
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
        $('input[name=keyword]').blur(function() {
            if (hidden) {
                $('.search-suggest').hide();
            }
        });
        $('input[name=keyword]').focus(function() {
            if ($('.search-suggest').html() !== '') {
                $('.search-suggest').show();
            }
        });

        $('input[name=keyword]').keypress(function(event) {
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
    <div id="main" class="page-detail">
        <div class="container">
            <div class="pad"></div>
            <div class="main-content main-detail">
                @include('home.detail.bread')

                @yield('content')

                <!-- keywords -->
                @if( !empty( $tagSelected ) )
                <div id="mv-keywords">
                    <strong class="mr10">Xem thêm:</strong>                    
                    @foreach( $tagSelected as $tag )
                    <a target="_blank" href="tags/{{ $tag->slug }}" title="{{ $tag->tag }}">
                       <h5>{{ $tag->tag }}</h5>
                    </a>                    
                    @endforeach           
                </div>
                @endif
                @if( $detail->content )

                <div class="content-kus" style="background: #fff;">
                    <?php echo $detail->content; ?>
                </div>
                @endif
                <!--<div id="commentfb">
                    <div class="fb-comments" data-href="film/zombie-massacre-14452/watching.html" data-width="100%" data-numposts="5"></div>
                </div>-->
                <div class="pad"></div>
                <!--related-->
                @include('home.detail.related')
                <!--/related-->               
            </div>

        </div>
    </div>
    </div>
    <div id="overlay"></div>
    <div class="modal fade modal-subc modal-error" id="pop-error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="subc-icon"><i class="fa fa-frown-o fa-4x"></i>
                    </div>
                    <h4>Oops!</h4>
                    <div class="clearfix"></div>
                    <p class="desc">The current streaming file is broken, do you want to stream from our back-up link?</p>
                    <div class="block">
                        <a class="btn btn-success" onclick="load_backup_episode()">Yes, please</a>
                        <a data-dismiss="modal" class="btn btn-default">No, thanks</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('home.detail.report-modal')   

    @include('home.index.footer')
    <script>
        if (!isCookieEnabled()) {
            $('#alert-cookie').css('display', 'block');
            $('body').addClass('off-cookie');
        }
    </script>


    <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js?v=0.1') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap-select.js?v=0.1') }}"></script>
    @yield('javascript_page')

    <script type="text/javascript">
        $(document).ready(function() {
            if (window.top !== window.self) {
                document.head.innerHTML = '';
                document.body.innerHTML = '';
            }
            if (!$.cookie('domain-alert')) {
                $.cookie('domain-alert', 1, {
                    expires: 1,
                    path: '/'
                });
                $('.alert-bottom').css('display', 'block');
                setInterval(function() {
                    $(".alert-bottom").remove();
                }, 15000);
            }
            $('#alert-bottom-close').click(function() {
                $(".alert-bottom").remove();
            });
        });
    </script>
    <input type="hidden" id="route_get_link" value="{{ route('get-link') }}">
</body>

</html>