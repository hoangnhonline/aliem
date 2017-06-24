@include('frontend.partials.meta')
@section('content')
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
		  poster="{{ $detail->image_url }}" data-setup='{"fluid": true}'>
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
   
      <div class="box movie-detail">
         <h1 class="title">{!! $detail->title !!}</h1>
         <p style="margin-top: 10px; padding: 0 10px;"><b>Ngày đăng:</b> {!! date('d-m-Y', strtotime($detail->created_at)) !!}, <b>Thời lượng:</b> {!! $detail->duration !!}</p>                  
      </div>
   
</div>
<div class="container">
   <div class="box" style="margin-top: 0 !important;">     
      <h3 class="title" style="font-weight: both">Phim liên quan</h3>
      <div class="movie-list">         
         @foreach($otherList as $vid)
         <div class="col-md-4 col-sm-6">
            <div class="video-item">
               <div class="item-thumbnail">
                  <a href="{{ route('detail', [ $vid->slug, $vid->id ]) }}" title="{!! $vid->title !!}" >
                     <img src="{!! $vid->image_url !!}" alt="{!! $vid->title !!}">
                     <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                  </a>
                  <span class="duration">{{ $vid->duration }}</span>
                  <!--<span class="quality">HD</span>-->
               </div>
               <div class="item-detail">
                  <h4><a href="{{ route('detail', [ $vid->slug, $vid->id ]) }}" title="{!! $vid->title !!}">{!! $vid->title !!}</a></h4>
                  <p>
                     <!--<span>47 views</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> 
                     <span>0 likes</span>
                     <i class="glyphicon glyphicon-one-fine-dot"></i> -->
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

@endsection
@section('javascript_page')
<script type="text/javascript">
	$(document).ready(function(){
		
	});
</script>
@endsection