<!DOCTYPE html>
<html>
   <!-- Mirrored from phim18.fun/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 15 May 2016 05:35:15 GMT -->
   <!-- Added by HTTrack -->
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <!-- /Added by HTTrack -->
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
       <meta property="og:locale" content="vi_VN" />
       <meta property="og:type" content="website" />
       <meta property="og:title" content="@yield('title')" />
       <meta property="og:description" content="@yield('site_description')" />
       <meta property="og:url" content="{{ url()->current() }}" />
       <meta property="og:site_name" content="Bao bì Hòa Hợp Phát" />
       <?php $socialImage = isset($socialImage) ? $socialImage : $settingArr['banner']; ?>
       <meta property="og:image" content="{{ Helper::showImage($socialImage) }}" />
       <meta name="csrf-token" content="{{ csrf_token() }}" />
       <meta name="twitter:card" content="summary" />
       <meta name="twitter:description" content="@yield('site_description')" />
       <meta name="twitter:title" content="@yield('title')" />        
       <meta name="twitter:image" content="{{ Helper::showImage($socialImage) }}" />
      <link rel="icon" href="{{ URL::asset('public/assets/images/favicon.ico') }}" type="image/x-icon">
      <style type="text/css">         
         body { font-family: 'Open Sans', sans-serif; margin: 0; margin-top: 50px !important; background: #F1F1F1 !important; line-height:1.7em; }
         a { color: #3d3d3d; text-decoration: none; }
         .sidebar { display: none; }
         .header-mobile { position: fixed; width: 100%; height: 50px; left: 0; top:0; background: #10151D; z-index: 200 !important; box-shadow: 0 0px 5px #373737; text-align: center; }
         .header-mobile img { height: 40px; margin: 5px 10px; }
         .header-mobile button.show-sidebar-left{ position: absolute; left: 10px; top: 10px; height: 30px; line-height: 30px; width: 40px; background: #282828; font-size: 20px; color: #FFF; border-radius: 3px; border: 0px; box-shadow: 0 1px 2px rgba(0,0,0,.5); text-align: center; }
         .breadcrumb-wrapper { display: none; }
         h1.title, h2.title, h3.title, h4.title { padding: 10px 10px 10px 10px; display: inline-block; margin-bottom: 0; margin-top: 0; font-family: 'Oswald', sans-serif; font-weight: 600; line-height: 1.1; }
         .order-link { float: right; padding: 10px 10px 5px 10px; }
         h1.title { font-size: 24px; }
         h3, .h3 { font-size: 23px; }
         .btn { border: 1px solid transparent; padding: 6px 12px; }
         .btn-group { position: relative; display: inline-block; vertical-align: middle; }
         .caret, .dropdown-menu { display: none; }
         .not-found-movie { margin-top: 25px !important; margin-bottom: 25px !important; color: #F00; }
      </style>
   </head>
   <body>
      <div class="main">
         <header class="sidebar">
            <div class="container">
               <div class="logo header-item"><a href="{{ route('home') }}" title="phim18.fun"><img src="{{ URL::asset('assets/img/logo.png') }}" alt="phim18.fun" /></a></div>
               <div class="form-search header-item">
                  <form onsubmit="return search();">
                     <div class="input-group">
                        <input type="text" class="form-control input-sm keyword" placeholder="Search..." autocomplete="off" value="" />
                        <span class="input-group-btn">
                        <button class="btn btn-sm btn-search" style="outline: 0;"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                     </div>
                  </form>
               </div>
               <div class="header-links header-item">
                  <ul>
                    @foreach($cateList as $cate)
                     <li><a href="{{ route('cate',[$cate->slug]) }}" title="{!! $cate->name !!}"><span>{!! $cate->name !!}</span></a></li>                     
                     @endforeach
                  </ul>
               </div>
            </div>
         </header>
         <div class="header-mobile">
            <button type="button" class="show-sidebar-left"><i class="glyphicon glyphicon-menu-hamburger"></i></button>
            <a href="index.html" title="phim18.fun"><img src="{{ URL::asset('assets/img/logo.png') }}" alt="phim18.fun" /></a>
         </div>
         <div class="main-page">
            @yield('bcrum')
            @yield('slider')
            @yield('content')
            
            
            <footer class="visible-sm-block visible-md-block visible-lg-block">
               <div class="footer-menu">
                  <div class="container">
                     <a href="index.html" title="phim18.fun">Home</a>
                     <a href="movie/keywords.html" title="Top Searches">Top Searches</a>
                     <!-- <a href="faq.html" title="FAQ">FAQ</a> -->
                     <a href="terms.html" title="Terms &amp; Conditions">Terms &amp; Conditions</a>
                     <a href="policy.html" title="Privacy Policy">Privacy policy</a>
                     <a href="contact.html" title="Contact">Contact us</a>
                     <a href="http://letfap.com/" title="FREE X-art Videos" style="color: #F97C00" target="_blank">FREE X-ART</a>
                  </div>
               </div>
               <div class="footer visible-md-block visible-lg-block">
                  <div class="container">
                     <div class="col-md-9">
                        <div class="footer-item newest-keyword">
                           <b style="color: #F99A16;">Newest Searches:</b>
                           <a href="movie25fc.html?q=party+mom" title="Party Mom">Party Mom</a>, 
                           <a href="moviec6d9.html?q=family+full+movies" title="Family Full Movies">Family Full Movies</a>, 
                           <a href="movied8cf.html?q=shaved+jap" title="Shaved Jap">Shaved Jap</a>, 
                           <a href="moviec841.html?q=tribbing+threesome" title="Tribbing Threesome">Tribbing Threesome</a>, 
                           <a href="moviefd0d.html?q=aoi+sa" title="Aoi Sa">Aoi Sa</a>, 
                           <a href="movie190a.html?q=porn+boob" title="Porn Boob">Porn Boob</a>, 
                           <a href="movie304b.html?q=ass+lic" title="Ass Lic">Ass Lic</a>, 
                           <a href="movie7b78.html?q=porn+jav" title="Porn Jav">Porn Jav</a>, 
                           <a href="movie7390.html?q=brendi+love" title="Brendi Love">Brendi Love</a>, 
                           <a href="movie4f94.html?q=big+ass+japanesa0" title="Big Ass Japanesa0">Big Ass Japanesa0</a>, 
                           <a href="moviea173.html?q=saeki+rei" title="Saeki Rei">Saeki Rei</a>, 
                           <a href="movie3525.html?q=pink+bikni" title="Pink Bikni">Pink Bikni</a>, 
                           <a href="movie5eb3.html?q=jav+enema" title="Jav Enema">Jav Enema</a>, 
                           <a href="movie3449.html?q=s+cup" title="S Cup">S Cup</a>, 
                           <a href="movie8990.html?q=yuu+asak" title="Yuu Asak">Yuu Asak</a>, 
                           <a href="moviec822.html?q=solo+cua+cogiaothao" title="Solo Cua Cogiaothao">Solo Cua Cogiaothao</a>, 
                           <a href="movie64bb.html?q=horny+skinny+asian+covered+in+cum" title="Horny Skinny Asian Covered In Cum">Horny Skinny Asian Covered In Cum</a>, 
                           <a href="movie8516.html?q=keiko+yoshikawa" title="Keiko Yoshikawa">Keiko Yoshikawa</a>, 
                           <a href="movie4c2c.html?q=maria+ozawa+white" title="Maria Ozawa White">Maria Ozawa White</a>, 
                           <a href="movie4f4c.html?q=amateur+miura" title="Amateur Miura">Amateur Miura</a>, 
                           ... (<a href="movie/keywords.html" title="Top Searches">See all</a>)
                        </div>
                        <div class="footer-item feature-list">
                           <div class="row">
                              <div class="col-md-4"><i class="glyphicon glyphicon-ok"></i> All is FREE!!!</div>
                              <div class="col-md-4"><i class="glyphicon glyphicon-ok"></i> Captured in True HD quality</div>
                              <div class="col-md-4"><i class="glyphicon glyphicon-ok"></i> Fastest Streaming Options</div>
                              <div class="col-md-4"><i class="glyphicon glyphicon-ok"></i> 100% Uncensored JAV</div>
                              <div class="col-md-4"><i class="glyphicon glyphicon-ok"></i> Featuring Top AV Idols</div>
                              <div class="col-md-4"><i class="glyphicon glyphicon-ok"></i> Mobile Access Anywhere</div>
                           </div>
                        </div>
                        <div class="footer-item">By entering this site you swear that you are of legal age in your area to view adult material and that you wish to view such material.</div>
                        <div class="footer-item copyright">© phim18.fun, 2016</div>
                        <img src="../widgets.amung.us/classic/18/1810.png') }}" style="border: 0; display: none;" />
                     </div>
                     <div class="col-md-3">
                        <div class="footer-item">
                        </div>
                     </div>
                  </div>
               </div>
            </footer>
         </div>
         <div class="overlay"></div>
      </div>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/bootstrap-theme.min.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style.min0c89.css') }}?_=20160405" />
      <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Oswald:300" />
      <script type='text/javascript' src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
      <!--[if lt IE 9]>
      <script type="text/javascript" src="{{ URL::asset('assets/js/respond.min.js') }}"></script>
      <![endif]-->
      <script type='text/javascript' src="{{ URL::asset('assets/js/ejs.min.js') }}"></script>
      <script type='text/javascript' src="{{ URL::asset('assets/js/jquery.cookie.js') }}"></script>		
      <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.caroufredsel-6.2.1.min.js') }}"></script>
      <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.touchSwipe.min.js') }}"></script>
      <script type="text/javascript" src="{{ URL::asset('assets/js/slider.js') }}"></script>
      @yield('javascript_page')
   </body>  
</html>
