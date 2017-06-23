<?php echo $__env->make('frontend.partials.meta', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>
<?php 
$urlGet = $detail->video_url;
$isXvideo = ( strpos($urlGet, 'xvideos') > 0 || strpos($urlGet, 'hihi.com') > 0 || strpos($urlGet, 'redtube.com') > 0 || strpos($urlGet, 'youporn.com') > 0 || strpos($urlGet, 'tnaflix.com') > 0 || strpos($urlGet, 'javbuz.com') > 0 || strpos($urlGet, 'letfap.com') > 0 ) ? 1 : 0;
	
if($isXvideo == 1){	
	require public_path()."/simplehtmldom/simple_html_dom.php";
	$chGet = curl_init($urlGet);	
	curl_setopt($chGet, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($chGet, CURLOPT_FOLLOWLOCATION, TRUE);
	if(strpos($urlGet, 'xvideos') > 0){
		curl_setopt($chGet, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; U; CPU like Mac OS X; en) AppleWebKit/420.1 (KHTML, like Gecko) Version/3.0 Mobile/3B48b Safari/419.3');    
	}
	curl_setopt($chGet, CURLOPT_AUTOREFERER, TRUE);
	$resultGet = curl_exec($chGet);    

	curl_close($chGet);    

	 // Create a DOM object
	$htmlGet = new simple_html_dom();
	// Load HTML from a string
	$htmlGet->load($resultGet);	
	
	if(strpos($urlGet, 'xvideos') > 0){			
		$aGet  = $htmlGet->find('script',7)->innertext;
		
		$tmp1 = explode("setVideoUrlHigh('", $resultGet);
		
		if(isset($tmp1[1])){
			$tmp2 = explode("');", $tmp1[1]);         
		}else{
			
			$tmp1 = explode("setVideoUrlLow('", $resultGet);     
			
			$tmp2 = explode("');", $tmp1[1]);         
		}      
		$urlVideo = $tmp2[0];
		
	}elseif(strpos($urlGet, 'hihi.com') > 0 ){
		$urlVideo = $htmlGet->find('source[data-res]', 0)->src;
	}elseif(strpos($urlGet, 'javbuz.com') > 0 ){
		$urlVideo = $htmlGet->find('source[data-res]', 0)->src;
		
	}elseif(strpos($urlGet, 'redtube.com') > 0){
		$urlVideo = $htmlGet->find('source', 0)->src;
	}elseif(strpos($urlGet, 'youporn.com') > 0){
		$urlVideo = $htmlGet->find('.downloadOption', 0)->find('a', 0)->href;
	}else{
		$htmlGet = file_get_html($urlGet);
		$urlVideo = "http:".$htmlGet->find('a.vaDown', 0)->href;
	}			
}
?>
 <link href="http://vjs.zencdn.net/6.1.0/video-js.css" rel="stylesheet">

  <!-- If you'd like to support IE8 -->
  <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
  <script src="http://vjs.zencdn.net/6.1.0/video.js"></script>
<div class="player-wrapper">
   <center>
      <div class="player-size clearfix container" >
      	<div style="width:80%" id="wrapper-video">
      	<video id="my-video" class="video-js vjs-16-9 vjs-big-play-centered vjs-default-skin" controls preload="auto" width="640" height="264"
		  poster="<?php echo e($detail->image_url); ?>" data-setup='{"fluid": true}'>
		    <source src="<?php echo $urlVideo;?>" type='video/mp4'>
		    
		    <p class="vjs-no-js">
		      To view this video please enable JavaScript, and consider upgrading to a web browser that
		      <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
		    </p>
		  </video>
		  </div>
      </div>
   </center>  
</div>
<div class="container">
   <div class="box" style="margin-bottom: 0;">
      Ads zone
   </div>
</div>
<div class="container">
   <div class="col-md-12">
      <div class="box movie-detail">
         <h1 class="title"><?php echo $detail->title; ?></h1>
         <p style="margin-top: 10px; padding: 0 10px;"><b>Ngày đăng:</b> <?php echo date('d-m-Y', strtotime($detail->created_at)); ?>, <b>Thời lượng:</b> <?php echo $detail->duration; ?></p>                  
      </div>
   </div>   
</div>
<div class="container">
   <div class="box" style="margin-top: 0 !important;">     
      <h3 class="title" style="font-weight: both">Phim liên quan</h3>
      <div class="movie-list">
         <div class="col-md-4 col-sm-6">
            <div class="video-item">
               <div class="item-thumbnail">
                  <a href="hot-aika-hoshino-gets-vibrator-on-her-clit.946.html" title="Hot Aika Hoshino gets vibrator on her clit" >
                     <img src="../../statics.phim18.fun/images/movies/phim18.fun-hot-aika-hoshino-gets-vibrator-on-her-clit.jpg" alt="Hot Aika Hoshino gets vibrator on her clit" />
                     <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                  </a>
                  <span class="duration">11:19</span>
                  <span class="quality">HD</span>
               </div>
               <div class="item-detail">
                  <h4><a href="hot-aika-hoshino-gets-vibrator-on-her-clit.946.html" title="Hot Aika Hoshino gets vibrator on her clit">Hot Aika Hoshino gets vibrator on her clit</a></h4>
                  <p>
                     <span>31,314 views</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>54 likes</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>2016-03-31</span>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-md-4 col-sm-6">
            <div class="video-item">
               <div class="item-thumbnail">
                  <a href="sporty-aika-hoshino-plays-with-sex-toys-to-stay-on-the-team.912.html" title="Sporty Aika Hoshino Plays With Sex Toys to Stay on the Team" >
                     <img src="../../statics.phim18.fun/images/movies/phim18.fun-sporty-aika-hoshino-plays-with-sex-toys-to-stay-on-the-team.jpg" alt="Sporty Aika Hoshino Plays With Sex Toys to Stay on the Team" />
                     <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                  </a>
                  <span class="duration">16:21</span>
                  <span class="quality">HD</span>
               </div>
               <div class="item-detail">
                  <h4><a href="sporty-aika-hoshino-plays-with-sex-toys-to-stay-on-the-team.912.html" title="Sporty Aika Hoshino Plays With Sex Toys to Stay on the Team">Sporty Aika Hoshino Plays With Sex Toys to Stay on the Team</a></h4>
                  <p>
                     <span>31,265 views</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>54 likes</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>2016-03-25</span>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-md-4 col-sm-6">
            <div class="video-item">
               <div class="item-thumbnail">
                  <a href="asuka--hardcore-into-kinky-doggy-style-sex.417.html" title="Asuka hardcore into kinky doggy style sex" >
                     <img src="../../statics.phim18.fun/images/movies/phim18.fun-asuka-hardcore-into-kinky-doggy-style-sex.jpg" alt="Asuka hardcore into kinky doggy style sex" />
                     <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                  </a>
                  <span class="duration">44:46</span>
                  <span class="quality">HD</span>
               </div>
               <div class="item-detail">
                  <h4><a href="asuka--hardcore-into-kinky-doggy-style-sex.417.html" title="Asuka hardcore into kinky doggy style sex">Asuka hardcore into kinky doggy style sex</a></h4>
                  <p>
                     <span>75,929 views</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>92 likes</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>2016-01-09</span>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-md-4 col-sm-6">
            <div class="video-item">
               <div class="item-thumbnail">
                  <a href="riko-masaki-in-uniform-is-deeply-fucked.511.html" title="Riko Masaki in uniform is deeply fucked" >
                     <img src="../../statics.phim18.fun/images/movies/phim18.fun-riko-masaki-in-uniform-is-deeply-fucked.jpg" alt="Riko Masaki in uniform is deeply fucked" />
                     <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                  </a>
                  <span class="duration">35:46</span>
                  <span class="quality">HD</span>
               </div>
               <div class="item-detail">
                  <h4><a href="riko-masaki-in-uniform-is-deeply-fucked.511.html" title="Riko Masaki in uniform is deeply fucked">Riko Masaki in uniform is deeply fucked</a></h4>
                  <p>
                     <span>64,103 views</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>114 likes</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>2016-01-24</span>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-md-4 col-sm-6">
            <div class="video-item">
               <div class="item-thumbnail">
                  <a href="shizuku--morino-gets-a-very-nice-creamed-pussy.318.html" title="Shizuku Morino gets a very nice creamed pussy" >
                     <img src="../../statics.phim18.fun/images/movies/phim18.fun-shizuku-morino-gets-a-very-nice-creamed-pussy.jpg" alt="Shizuku Morino gets a very nice creamed pussy" />
                     <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                  </a>
                  <span class="duration">57:10</span>
                  <span class="quality">HD</span>
               </div>
               <div class="item-detail">
                  <h4><a href="shizuku--morino-gets-a-very-nice-creamed-pussy.318.html" title="Shizuku Morino gets a very nice creamed pussy">Shizuku Morino gets a very nice creamed pussy</a></h4>
                  <p>
                     <span>196,723 views</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>320 likes</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>2015-12-24</span>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-md-4 col-sm-6">
            <div class="video-item">
               <div class="item-thumbnail">
                  <a href="aika-hoshin-naughty-cat-licks-hard-cock.836.html" title="Aika Hoshin naughty cat licks hard cock" >
                     <img src="../../statics.phim18.fun/images/movies/phim18.fun-aika-hoshin-naughty-cat-licks-hard-cock.jpg" alt="Aika Hoshin naughty cat licks hard cock" />
                     <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                  </a>
                  <span class="duration">29:18</span>
                  <span class="quality">HD</span>
               </div>
               <div class="item-detail">
                  <h4><a href="aika-hoshin-naughty-cat-licks-hard-cock.836.html" title="Aika Hoshin naughty cat licks hard cock">Aika Hoshin naughty cat licks hard cock</a></h4>
                  <p>
                     <span>37,055 views</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>46 likes</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>2016-03-15</span>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-md-4 col-sm-6">
            <div class="video-item">
               <div class="item-thumbnail">
                  <a href="busty-jav-super-pornstar-yukina-mori-gets-cum-in-her-pussy.653.html" title="Busty JAV Super pornstar Yukina Mori Gets Cum in her Pussy" >
                     <img src="../../statics.phim18.fun/images/movies/phim18.fun-busty-jav-superstar-yukina-mori-gets-cum-in-her-pussy.jpg" alt="Busty JAV Super pornstar Yukina Mori Gets Cum in her Pussy" />
                     <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                  </a>
                  <span class="duration">37:05</span>
                  <span class="quality">HD</span>
               </div>
               <div class="item-detail">
                  <h4><a href="busty-jav-super-pornstar-yukina-mori-gets-cum-in-her-pussy.653.html" title="Busty JAV Super pornstar Yukina Mori Gets Cum in her Pussy">Busty JAV Super pornstar Yukina Mori Gets Cum in her Pussy</a></h4>
                  <p>
                     <span>271,245 views</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>489 likes</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>2016-02-15</span>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-md-4 col-sm-6">
            <div class="video-item">
               <div class="item-thumbnail">
                  <a href="schoolgirl--yukari-gets-a-creampie-during-a-field-trip.682.html" title="Schoolgirl Yukari gets a Creampie During a Field Trip" >
                     <img src="../../statics.phim18.fun/images/movies/phim18.fun-schoolgirl-yukari-gets-a-creampie-during-a-field-trip.jpg" alt="Schoolgirl Yukari gets a Creampie During a Field Trip" />
                     <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                  </a>
                  <span class="duration">28:31</span>
                  <span class="quality">HD</span>
               </div>
               <div class="item-detail">
                  <h4><a href="schoolgirl--yukari-gets-a-creampie-during-a-field-trip.682.html" title="Schoolgirl Yukari gets a Creampie During a Field Trip">Schoolgirl Yukari gets a Creampie During a Field Trip</a></h4>
                  <p>
                     <span>79,632 views</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>161 likes</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>2016-02-20</span>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-md-4 col-sm-6">
            <div class="video-item">
               <div class="item-thumbnail">
                  <a href="aika-hoshino-is-fucked-through-crotchless.803.html" title="Aika Hoshino is fucked through crotchless" >
                     <img src="../../statics.phim18.fun/images/movies/phim18.fun-aika-hoshino-is-fucked-through-crotchless.jpg" alt="Aika Hoshino is fucked through crotchless" />
                     <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                  </a>
                  <span class="duration">35:36</span>
                  <span class="quality">HD</span>
               </div>
               <div class="item-detail">
                  <h4><a href="aika-hoshino-is-fucked-through-crotchless.803.html" title="Aika Hoshino is fucked through crotchless">Aika Hoshino is fucked through crotchless</a></h4>
                  <p>
                     <span>44,383 views</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>46 likes</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>2016-03-10</span>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-md-4 col-sm-6">
            <div class="video-item">
               <div class="item-thumbnail">
                  <a href="ai-sakura-licks-woody-while-is-screwed.1030.html" title="Ai Sakura licks woody while is screwed" >
                     <img src="../../statics.phim18.fun/images/movies/phim18.fun-ai-sakura-licks-woody-while-is-screwed.jpg" alt="Ai Sakura licks woody while is screwed" />
                     <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                  </a>
                  <span class="duration">33:41</span>
                  <span class="quality">HD</span>
               </div>
               <div class="item-detail">
                  <h4><a href="ai-sakura-licks-woody-while-is-screwed.1030.html" title="Ai Sakura licks woody while is screwed">Ai Sakura licks woody while is screwed</a></h4>
                  <p>
                     <span>27,904 views</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>28 likes</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>2016-04-14</span>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-md-4 col-sm-6">
            <div class="video-item">
               <div class="item-thumbnail">
                  <a href="horny--teen-porn-star-riko-masaki-into-hot-fucking-action.594.html" title="Horny teen porn star Riko Masaki into hot fucking action" >
                     <img src="../../statics.phim18.fun/images/movies/phim18.fun-horny-teen-porn-star-riko-masaki-into-hot-fucking-action.jpg" alt="Horny teen porn star Riko Masaki into hot fucking action" />
                     <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                  </a>
                  <span class="duration">33:34</span>
                  <span class="quality">HD</span>
               </div>
               <div class="item-detail">
                  <h4><a href="horny--teen-porn-star-riko-masaki-into-hot-fucking-action.594.html" title="Horny teen porn star Riko Masaki into hot fucking action">Horny teen porn star Riko Masaki into hot fucking action</a></h4>
                  <p>
                     <span>46,310 views</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>79 likes</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>2016-02-06</span>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-md-4 col-sm-6">
            <div class="video-item">
               <div class="item-thumbnail">
                  <a href="naughty-schoolgirl-aika-hoshino-nailed-by-her-teachers.923.html" title="Naughty Schoolgirl Aika Hoshino Nailed by Her Teachers" >
                     <img src="../../statics.phim18.fun/images/movies/phim18.fun-naughty-schoolgirl-aika-hoshino-nailed-by-her-teachers.jpg" alt="Naughty Schoolgirl Aika Hoshino Nailed by Her Teachers" />
                     <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                  </a>
                  <span class="duration">21:31</span>
                  <span class="quality">HD</span>
               </div>
               <div class="item-detail">
                  <h4><a href="naughty-schoolgirl-aika-hoshino-nailed-by-her-teachers.923.html" title="Naughty Schoolgirl Aika Hoshino Nailed by Her Teachers">Naughty Schoolgirl Aika Hoshino Nailed by Her Teachers</a></h4>
                  <p>
                     <span>48,709 views</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>60 likes</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>2016-03-27</span>
                  </p>
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
   </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript_page'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		
	});
</script>
<?php $__env->stopSection(); ?>