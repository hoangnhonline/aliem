<!DOCTYPE html>
<html>
   <!-- Mirrored from javhihi.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 15 May 2016 05:35:15 GMT -->
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
               <div class="logo header-item"><a href="index.html" title="JavHiHi.com"><img src="{{ URL::asset('assets/img/logo.png') }}" alt="JavHiHi.com" /></a></div>
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
                     <li><a href="index.html" title="JavHiHi.com" class="active" ><i class="glyphicon glyphicon-home"></i><span>Home</span></a></li>
                     <li><a href="movie.html" title="JAV Videos"  ><i class="glyphicon glyphicon-film"></i><span>Videos</span></a></li>
                     <li class="dropdown">
                        <a  title="Categories"><i class="glyphicon glyphicon-list-alt"></i><span>Categories</span></a>
                        <div class="categories-wrapper " >
                           <div class="row">
                              <div class="col-sm-4"><a href="movie/amateur.html" title="Amateur" >Amateur</a></div>
                              <div class="col-sm-4"><a href="movie/anal.html" title="Anal" >Anal</a></div>
                              <div class="col-sm-4"><a href="movie/big-tits.html" title="Big Tits" >Big Tits</a></div>
                              <div class="col-sm-4"><a href="movie/bikini.html" title="Bikini" >Bikini</a></div>
                              <div class="col-sm-4"><a href="movie/blowjob.html" title="Blowjob" >Blowjob</a></div>
                              <div class="col-sm-4"><a href="movie/bondage.html" title="Bondage BDSM" >Bondage BDSM</a></div>
                              <div class="col-sm-4"><a href="movie/bukkake.html" title="Bukkake" >Bukkake</a></div>
                              <div class="col-sm-4"><a href="movie/cosplay.html" title="Cosplay" >Cosplay</a></div>
                              <div class="col-sm-4"><a href="movie/creampie.html" title="Creampies" >Creampies</a></div>
                              <div class="col-sm-4"><a href="movie/cumshot.html" title="Cumshot" >Cumshot</a></div>
                              <div class="col-sm-4"><a href="movie/double-penetration.html" title="Double Penetrated" >Double Penetrated</a></div>
                              <div class="col-sm-4"><a href="movie/facial.html" title="Facial" >Facial</a></div>
                              <div class="col-sm-4"><a href="movie/fingering.html" title="Fingering" >Fingering</a></div>
                              <div class="col-sm-4"><a href="movie/footjob.html" title="Footjob" >Footjob</a></div>
                              <div class="col-sm-4"><a href="movie/gang-bang.html" title="Gang bang" >Gang bang</a></div>
                              <div class="col-sm-4"><a href="movie/group-sex.html" title="Group Sex" >Group Sex</a></div>
                              <div class="col-sm-4"><a href="movie/hairy-pussy.html" title="Hairy pussy" >Hairy pussy</a></div>
                              <div class="col-sm-4"><a href="movie/handjob.html" title="Handjob" >Handjob</a></div>
                              <div class="col-sm-4"><a href="movie/hardcore.html" title="Hardcore" >Hardcore</a></div>
                              <div class="col-sm-4"><a href="movie/lesbian.html" title="Lesbian" >Lesbian</a></div>
                              <div class="col-sm-4"><a href="movie/lingerie.html" title="Lingerie" >Lingerie</a></div>
                              <div class="col-sm-4"><a href="movie/maid.html" title="Maid" >Maid</a></div>
                              <div class="col-sm-4"><a href="movie/masturbation.html" title="Masturbation" >Masturbation</a></div>
                              <div class="col-sm-4"><a href="movie/mature.html" title="Mature" >Mature</a></div>
                              <div class="col-sm-4"><a href="movie/milf.html" title="Milf" >Milf</a></div>
                              <div class="col-sm-4"><a href="movie/mini-skirt.html" title="Mini Skirt" >Mini Skirt</a></div>
                              <div class="col-sm-4"><a href="movie/nurse.html" title="Nurse" >Nurse</a></div>
                              <div class="col-sm-4"><a href="movie/office-lady.html" title="Office Lady" >Office Lady</a></div>
                              <div class="col-sm-4"><a href="movie/outdoor.html" title="Outdoor" >Outdoor</a></div>
                              <div class="col-sm-4"><a href="movie/pov.html" title="POV" >POV</a></div>
                              <div class="col-sm-4"><a href="movie/schoolgirl.html" title="Schoolgirl" >Schoolgirl</a></div>
                              <div class="col-sm-4"><a href="movie/shaved-pussy.html" title="Shaved Pussy" >Shaved Pussy</a></div>
                              <div class="col-sm-4"><a href="movie/squirting.html" title="Squirting" >Squirting</a></div>
                              <div class="col-sm-4"><a href="movie/stockings.html" title="Stockings" >Stockings</a></div>
                              <div class="col-sm-4"><a href="movie/teen.html" title="Teen" >Teen</a></div>
                              <div class="col-sm-4"><a href="movie/threesome.html" title="Threesome" >Threesome</a></div>
                              <div class="col-sm-4"><a href="movie/tit-fuck.html" title="Tit fuck" >Tit fuck</a></div>
                              <div class="col-sm-4"><a href="movie/toys.html" title="Sex Toys" >Sex Toys</a></div>
                              <div class="clearfix"></div>
                           </div>
                        </div>
                     </li>
                     <li><a href="pornstar.html" title="Top Japanese AV Idols"  ><i class="glyphicon glyphicon-star"></i><span>Pornstars</span></a></li>
                     <li class="visible-xs-block"><a href="movie/keywords.html" title="Top Searches"  ><i class="glyphicon glyphicon-search"></i><span>Top Searches</span></a></li>
                     <li class="visible-xs-block" style="background: #F97C00; color: #fff;"><a href="http://letfap.com/" title="Free X-art" style="color: #fff;"><i class="glyphicon glyphicon-link"></i><span>Free X-art Videos</span></a></li>
                     <li class="visible-xs-block menu-divider"><i class="glyphicon glyphicon-option-horizontal"></i></li>
                     <li class="visible-xs-block"><a href="terms.html" title="Terms &amp; Conditions"  ><i class="glyphicon glyphicon-warning-sign"></i><span>Terms &amp; Conditions</span></a></li>
                     <li class="visible-xs-block"><a href="policy.html" title="Privacy Policy"  ><i class="glyphicon glyphicon-warning-sign"></i><span>Privacy policy</span></a></li>
                     <li class="visible-xs-block"><a href="contact.html" title="Contact"  ><i class="glyphicon glyphicon-envelope"></i><span>Contact us</span></a></li>
                     <li class="visible-xs-block copyright">© JavHiHi.com, 2016</li>
                  </ul>
               </div>
            </div>
         </header>
         <div class="header-mobile">
            <button type="button" class="show-sidebar-left"><i class="glyphicon glyphicon-menu-hamburger"></i></button>
            <a href="index.html" title="JavHiHi.com"><img src="{{ URL::asset('assets/img/logo.png') }}" alt="JavHiHi.com" /></a>
         </div>
         <div class="main-page">
            <section class="breadcrumb-wrapper visible-md-block visible-lg-block">
               <div class="container">
                  <ol class="breadcrumb">
                     <li>
                        <h1>Free JAVHD, Japanese Porn, Asian Sex Videos - JavHiHi</h1>
                     </li>
                  </ol>
               </div>
            </section>
            <section id="slider">
               <div id="head-carousel">
                  <div class="is-carousel" style="z-index: 1;" id="metro-carousel" data-notauto=0 data-auto_timeout=5000 data-auto_duration=600>
                     <div class="carousel-content">
                        <div class="video-item">
                           <div class="item-thumbnail">
                              <a href="movie/sexy-spy-sumire-matsu-takes-load-of-cum-in-her-pussy.1184.html" title="Sexy Spy Sumire Matsu Takes Load of Cum in Her Pussy" >
                                 <img src="{{ URL::asset('images/movies/javhihi.com-sexy-spy-sumire-matsu-takes-load-of-cum-in-her-pussy.jpg') }}" width="748" height="421" alt="Sexy Spy Sumire Matsu Takes Load of Cum in Her Pussy">
                                 <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                              </a>
                              <div class="item-head">
                                 <h3><a href="movie/sexy-spy-sumire-matsu-takes-load-of-cum-in-her-pussy.1184.html"  title="Sexy Spy Sumire Matsu Takes Load of Cum in Her Pussy">Sexy Spy Sumire Matsu Takes Load of Cum in Her Pussy</a></h3>
                                 <span>
                                 </span>
                              </div>
                           </div>
                        </div>
                        <div class="video-item">
                           <div class="video-item">
                              <div class="item-thumbnail">
                                 <a href="movie/suzu-minamoto-with-big-butt-is-screwed.1196.html" title="Suzu Minamoto with big butt is screwed" >
                                    <img src="{{ URL::asset('images/movies/javhihi.com-suzu-minamoto-with-big-butt-is-screwed.jpg') }}" width="356" height="200" alt="Suzu Minamoto with big butt is screwed">
                                    <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                                 </a>
                                 <div class="item-head">
                                    <h3><a href="movie/suzu-minamoto-with-big-butt-is-screwed.1196.html">Suzu Minamoto with big butt is screwed</a></h3>
                                 </div>
                              </div>
                           </div>
                           <div class="video-item">
                              <div class="item-thumbnail">
                                 <a href="movie/suzu-minamoto-sucks-dick-while-gets-cock.1166.html" title="Suzu Minamoto sucks dick while gets cock" >
                                    <img src="{{ URL::asset('images/movies/javhihi.com-suzu-minamoto-sucks-dick-while-gets-cock.jpg') }}" width="356" height="200" alt="Suzu Minamoto sucks dick while gets cock">
                                    <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                                 </a>
                                 <div class="item-head">
                                    <h3><a href="movie/suzu-minamoto-sucks-dick-while-gets-cock.1166.html">Suzu Minamoto sucks dick while gets cock</a></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="video-item">
                           <div class="video-item">
                              <div class="item-thumbnail">
                                 <a href="movie/marika-s-japan-girl-blowjob-ends-in-a-pussy-creampie.1159.html" title="Marika's japan girl blowjob ends in a pussy creampie" >
                                    <img src="{{ URL::asset('images/movies/javhihi.com-marika-s-japan-girl-blowjob-ends-in-a-pussy-creampie.jpg') }}" width="356" height="200" alt="Marika's japan girl blowjob ends in a pussy creampie">
                                    <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                                 </a>
                                 <div class="item-head">
                                    <h3><a href="movie/marika-s-japan-girl-blowjob-ends-in-a-pussy-creampie.1159.html">Marika's japan girl blowjob ends in a pussy creampie</a></h3>
                                 </div>
                              </div>
                           </div>
                           <div class="video-item">
                              <div class="item-thumbnail">
                                 <a href="movie/ruhime-maiori-is-nailed-in-dark-poonanie.1137.html" title="Ruhime Maiori is nailed in dark poonanie" >
                                    <img src="{{ URL::asset('images/movies/javhihi.com-ruhime-maiori-is-nailed-in-dark-poonanie.jpg') }}" width="356" height="200" alt="Ruhime Maiori is nailed in dark poonanie">
                                    <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                                 </a>
                                 <div class="item-head">
                                    <h3><a href="movie/ruhime-maiori-is-nailed-in-dark-poonanie.1137.html">Ruhime Maiori is nailed in dark poonanie</a></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="video-item">
                           <div class="item-thumbnail">
                              <a href="movie/kaoru-natsuki-has-strong-fuck-of-nooky.1125.html" title="Kaoru Natsuki has strong fuck of nooky" >
                                 <img src="{{ URL::asset('images/movies/javhihi.com-kaoru-natsuki-has-strong-fuck-of-nooky.jpg') }}" width="748" height="421" alt="Kaoru Natsuki has strong fuck of nooky">
                                 <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                              </a>
                              <div class="item-head">
                                 <h3><a href="movie/kaoru-natsuki-has-strong-fuck-of-nooky.1125.html"  title="Kaoru Natsuki has strong fuck of nooky">Kaoru Natsuki has strong fuck of nooky</a></h3>
                                 <span>
                                 </span>
                              </div>
                           </div>
                        </div>
                        <div class="video-item">
                           <div class="video-item">
                              <div class="item-thumbnail">
                                 <a href="movie/saori-s-make-out-session-turns-into-hardcore-fucking.1090.html" title="Saori's Make out Session Turns into Hardcore Fucking" >
                                    <img src="{{ URL::asset('images/movies/javhihi.com-saori-s-make-out-session-turns-into-hardcore-fucking.jpg') }}" width="356" height="200" alt="Saori's Make out Session Turns into Hardcore Fucking">
                                    <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                                 </a>
                                 <div class="item-head">
                                    <h3><a href="movie/saori-s-make-out-session-turns-into-hardcore-fucking.1090.html">Saori's Make out Session Turns into Hardcore Fucking</a></h3>
                                 </div>
                              </div>
                           </div>
                           <div class="video-item">
                              <div class="item-thumbnail">
                                 <a href="movie/ruri-hayami-s-milf-pussy-gets-creampied-in-a-threesome.1105.html" title="Ruri Hayami's MILF Pussy Gets Creampied In A Threesome" >
                                    <img src="{{ URL::asset('images/movies/javhihi.com-ruri-hayami-s-milf-pussy-gets-creampied-in-a-threesome.jpg') }}" width="356" height="200" alt="Ruri Hayami's MILF Pussy Gets Creampied In A Threesome">
                                    <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                                 </a>
                                 <div class="item-head">
                                    <h3><a href="movie/ruri-hayami-s-milf-pussy-gets-creampied-in-a-threesome.1105.html">Ruri Hayami's MILF Pussy Gets Creampied In A Threesome</a></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="video-item">
                           <div class="video-item">
                              <div class="item-thumbnail">
                                 <a href="movie/two-guys-fuck-sana-anju-s-tight-holes-in-class.1107.html" title="Two Guys Fuck Sana Anju's Tight Holes In Class" >
                                    <img src="{{ URL::asset('images/movies/javhihi.com-two-guys-fuck-sana-anju-s-tight-holes-in-class.jpg') }}" width="356" height="200" alt="Two Guys Fuck Sana Anju's Tight Holes In Class">
                                    <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                                 </a>
                                 <div class="item-head">
                                    <h3><a href="movie/two-guys-fuck-sana-anju-s-tight-holes-in-class.1107.html">Two Guys Fuck Sana Anju's Tight Holes In Class</a></h3>
                                 </div>
                              </div>
                           </div>
                           <div class="video-item">
                              <div class="item-thumbnail">
                                 <a href="movie/akina-hara-licks-and-sucks-two-shlongs.1044.html" title="Akina Hara licks and sucks two shlongs" >
                                    <img src="{{ URL::asset('images/movies/javhihi.com-akina-hara-licks-and-sucks-two-shlongs.jpg') }}" width="356" height="200" alt="Akina Hara licks and sucks two shlongs">
                                    <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                                 </a>
                                 <div class="item-head">
                                    <h3><a href="movie/akina-hara-licks-and-sucks-two-shlongs.1044.html">Akina Hara licks and sucks two shlongs</a></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="video-item">
                           <div class="item-thumbnail">
                              <a href="movie/yuu-sakura-in-a-hot-horny-and-hardcore-action.1084.html" title="Yuu Sakura in a hot, horny and hardcore action" >
                                 <img src="{{ URL::asset('images/movies/javhihi.com-yuu-sakura-in-a-hot-horny-and-hardcore-action.jpg') }}" width="748" height="421" alt="Yuu Sakura in a hot, horny and hardcore action">
                                 <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                              </a>
                              <div class="item-head">
                                 <h3><a href="movie/yuu-sakura-in-a-hot-horny-and-hardcore-action.1084.html"  title="Yuu Sakura in a hot, horny and hardcore action">Yuu Sakura in a hot, horny and hardcore action</a></h3>
                                 <span>
                                 </span>
                              </div>
                           </div>
                        </div>
                        <div class="video-item">
                           <div class="video-item">
                              <div class="item-thumbnail">
                                 <a href="movie/toys-fucking-hina-maeda-s-pussy-makes-her-squirt.1083.html" title="Toys Fucking Hina Maeda's Pussy Makes Her Squirt" >
                                    <img src="{{ URL::asset('images/movies/javhihi.com-toys-fucking-hina-maeda-s-pussy-makes-her-squirt.jpg') }}" width="356" height="200" alt="Toys Fucking Hina Maeda's Pussy Makes Her Squirt">
                                    <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                                 </a>
                                 <div class="item-head">
                                    <h3><a href="movie/toys-fucking-hina-maeda-s-pussy-makes-her-squirt.1083.html">Toys Fucking Hina Maeda's Pussy Makes Her Squirt</a></h3>
                                 </div>
                              </div>
                           </div>
                           <div class="video-item">
                              <div class="item-thumbnail">
                                 <a href="movie/satomi-suzuki-busty-is-fucked-like-crazy.1046.html" title="Satomi Suzuki busty is fucked like crazy" >
                                    <img src="{{ URL::asset('images/movies/javhihi.com-satomi-suzuki-busty-is-fucked-like-crazy.jpg') }}" width="356" height="200" alt="Satomi Suzuki busty is fucked like crazy">
                                    <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                                 </a>
                                 <div class="item-head">
                                    <h3><a href="movie/satomi-suzuki-busty-is-fucked-like-crazy.1046.html">Satomi Suzuki busty is fucked like crazy</a></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="video-item">
                           <div class="video-item">
                              <div class="item-thumbnail">
                                 <a href="movie/mai-asahina-s-pussy-oozes-cum-after-a-threesome.1013.html" title="Mai Asahina's Pussy Oozes Cum After A Threesome" >
                                    <img src="{{ URL::asset('images/movies/javhihi.com-mai-asahina-s-pussy-oozes-cum-after-a-threesome.jpg') }}" width="356" height="200" alt="Mai Asahina's Pussy Oozes Cum After A Threesome">
                                    <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                                 </a>
                                 <div class="item-head">
                                    <h3><a href="movie/mai-asahina-s-pussy-oozes-cum-after-a-threesome.1013.html">Mai Asahina's Pussy Oozes Cum After A Threesome</a></h3>
                                 </div>
                              </div>
                           </div>
                           <div class="video-item">
                              <div class="item-thumbnail">
                                 <a href="movie/noriko-kago-gets-fondled-and-fucked-in-every-way.1011.html" title="Noriko Kago gets fondled and fucked in every way!" >
                                    <img src="{{ URL::asset('images/movies/javhihi.com-noriko-kago-gets-fondled-and-fucked-in-every-way.jpg') }}" width="356" height="200" alt="Noriko Kago gets fondled and fucked in every way!">
                                    <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                                 </a>
                                 <div class="item-head">
                                    <h3><a href="movie/noriko-kago-gets-fondled-and-fucked-in-every-way.1011.html">Noriko Kago gets fondled and fucked in every way!</a></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!--/carousel-content-->
                     <div class="carousel-button">
                        <a href="#" class="prev maincolor1 bordercolor1 bgcolor1hover"><i class="glyphicon glyphicon-menu-left"></i></a>
                        <a href="#" class="next maincolor1 bordercolor1 bgcolor1hover"><i class="glyphicon glyphicon-menu-right"></i></a>
                     </div>
                     <!--/carousel-button-->
                  </div>
                  <!--/is-carousel-->
               </div>
               <!--head-carousel-->
            </section>
            <!--/slider--> 
            @foreach($cateList as $cate)    
            <div class="container">
               <div class="box">
                  <div class="clearfix"></div>
                  <h3 class="title">{!! $cate->name !!} <a href="movie.html" title="View more newest movies"><i class="glyphicon glyphicon-chevron-right"></i></a></h3>
                  <div class="movie-list">
                      @foreach($moviesArr[$cate->id] as $vid)
                     <div class="col-md-4 col-sm-6">
                        <div class="video-item">
                           <div class="item-thumbnail">
                              <a href="movie/meguru-kosaka-sucks-joystick-in-wild-69.1228.html" title="{!! $vid->title !!}" >
                                 <img src="{!! $vid->image_url !!}" alt="{!! $vid->title !!}">
                                 <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                              </a>
                              <span class="duration">18:37</span>
                              <span class="quality">HD</span>
                           </div>
                           <div class="item-detail">
                              <h4><a href="movie/meguru-kosaka-sucks-joystick-in-wild-69.1228.html" title="{!! $vid->title !!}">{!! $vid->title !!}</a></h4>
                              <p>
                                 <span>47 views</span>
                                 <i class="glyphicon glyphicon-one-fine-dot"></i> 
                                 <span>0 likes</span>
                                 <i class="glyphicon glyphicon-one-fine-dot"></i> 
                                 <span>{!! date('d-m-Y H:i', strtotime($vid->created_at)) !!}</span>
                              </p>
                           </div>
                        </div>
                     </div>                     
                     @endforeach
                  </div>
                  <div class="clearfix"></div>
               </div>
            </div>           
            @endforeach
            
            <footer class="visible-sm-block visible-md-block visible-lg-block">
               <div class="footer-menu">
                  <div class="container">
                     <a href="index.html" title="JavHiHi.com">Home</a>
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
                        <div class="footer-item copyright">© JavHiHi.com, 2016</div>
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
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" />
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
   </body>  
</html>
