@section('title'){{ $title }}@endsection
@section('site_description')<?php echo $description == "" ? strip_tags($settingArr['site_description']) : str_replace('&nbsp;', ' ',strip_tags($description)); ?>@endsection
@section('site_keywords'){{ strip_tags($detail->meta_keywords) or strip_tags($settingArr['site_keywords']) }}@endsection
@section('banner'){{ $settingArr['banner'] }}@endsection
@section('facebook_appid'){{ $settingArr['facebook_appid'] }}@endsection
@section('site_name'){{ $settingArr['site_name'] }}@endsection
@section('favicon'){{ Helper::showImage($settingArr['favicon']) }}@endsection
@section('logo'){{ Helper::showImage($settingArr['logo']) }}@endsection
<div id="mv-info">
    <!--<div class="play-notice">
        <div class="alert alert-warning" style="margin-bottom: 0; border-radius: 0;">
            <i class="fa fa-warning mr5"></i> If the movie does not work, please try to stream it with other browser.
        </div>
    </div>-->

    <div class="wrapper" id="play-video">
       
    </div>   
    <!-- Load player -->

    <div id="bar-player">
        <a href="#mv-info" rel="nofollow" class="btn bp-btn-light"><i class="fa fa-lightbulb-o"></i> <span></span></a>
        @if(Session::get('userId') > 0)
        <span id="button-favorite">
                        
                        <a rel="nofollow" style="{{ in_array($detail->id, $arrKhoPhim) ? "display:none" : "" }}" data-value="{{ $detail->id }}" data-status="1"
                           class="btn bp-btn-like addFavorite" id="addFavorite"><i class="fa fa-heart"></i>

                Yêu thích</a>
                
                     <a rel="nofollow" style="{{ !in_array($detail->id, $arrKhoPhim) ? "display:none" : "" }}" data-value="{{ $detail->id }}" data-status="0"
                           class="btn bp-btn-like addFavorite" id="removeFavorite">
                Bỏ yêu thích</a>   
        </span>
        @endif
        @if(!$has_report)
        <a class="btn bp-btn-report" id="btnReport" data-ep="{{ $episodeActive->id }}" data-value="{{ $detail->id }}"><i class="fa fa-warning"></i> Báo link hỏng</a>
        @endif
        <div class="clearfix"></div>
    </div>
    <!--<div class="mobile-btn">
        <a class="btn btn-block btn-lg btn-success btn-01" target="_blank" href="http://players.123movies.to/stream.php"><i class="fa fa-play mr10"></i>Stream in HD</a>
        <a class="btn btn-block btn-lg btn-success btn-02" target="_blank" href="http://players.123movies.to/download.php"><i class="fa fa-download mr10"></i>Download in HD</a>
        <div class="clearfix"></div>
    </div>--> 
    <div id="report-alert" style="display:none">
        <div class="alert alert-success" role="alert">
            <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">×</a>
            <i class="fa fa-check"></i> Cảm ơn bạn đã gửi báo cáo. Chúng tôi sẽ cố gắng chỉnh sửa sớm nhất.
        </div>
    </div>
    @if( $episode && $detail->type == 2)
    <div id="list-eps">
        <div class="le-server">
            <div class="les-content">                
                @foreach( $episode as $ep )
                <a class="btn-eps {{ $ep->id == $episodeActive->id ? "active" : "" }} " id="eps-{{ $ep->id }}" href="{{ route('detail-tap-phim', ['slugName' => $detail->slug, 'slugEpisode' => $ep->slug]) }}">{{ $ep->name }}</a>
                @endforeach
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    @endif
    @if($settingArr['w_ads_1'])
    <div class="content-kus" style="text-align: center; margin: 20px 0; padding: 15px; background-color: #FFF">
        {{ $settingArr['w_ads_1'] }}
    </div>
    @endif
    <div class="mvi-content">
        <!--<div class="mvic-btn">
            <div class="mv-rating">

            </div>
            <div class="clearfix"></div>          
            <a href="http://players.123movies.to/stream.php" target="_blank" class="btn btn-block btn-lg btn-success btn-01"><i
                class="fa fa-play mr10"></i>
            Stream in HD</a>
            <a href="http://players.123movies.to/download.php" target="_blank" class="btn btn-block btn-lg btn-success btn-02"><i class="fa fa-download mr10"></i>
            Download in HD</a>
           

        </div> -->
        <div class="thumb mvic-thumb col-md-2" style="background-image: url({{ Helper::showImage( $detail->image_url ) }});"></div>
        <div class="mvic-desc col-md-7">
            <h1 class="title">{{ $detail->title }}</h1>
            @if( $detail->trailer != '')
            <div class="block-trailer">
                <a data-target="#pop-trailer" data-toggle="modal" class="btn btn-primary">
                    <i class="fa fa-video-camera mr5"></i>Trailer
                </a>
            </div>
            @endif
            <div class="block-social">

                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_native_toolbox"></div>

            </div>
            <div class="desc">
                {{ $detail->description }}
            </div>
            <div class="mvic-info">
                <div class="mvici-left">
                    <p>
                        <strong>Thể loại: </strong>
                        <?php $tmp = $detail->filmCategoryName($detail->id ); 
                        $countTmp = count($tmp);
                        $i = 0;
                        ?>
                            @foreach($detail->filmCategoryName($detail->id ) as $value)
                            <?php $i++; ?>
                            <a href="{{ route('cate', $value['slug']) }}" title="{{ $value['name'] }}">{{ $value['name'] }}</a><?php if($i < $countTmp) echo ", "; ?> 
                            @endforeach
                        </p>
                    <p>
                        <strong>Diễn viên: </strong>
                         <?php $tmp = $detail->filmCrewShow($detail->id, 1); 
                        $countTmp = count($tmp);
                        $i = 0;
                        ?>
                        @if($countTmp > 0)
                            @foreach($detail->filmCrewShow($detail->id, 1) as $value)
                            <?php $i++; ?>
                            <a href="{{ route('dien-vien', $value['slug']) }}" title="{{ $value['name'] }}">{{ $value['name'] }}</a><?php if($i < $countTmp && $i > 1) echo ", "; ?> 
                            @endforeach
                        @endif
                       </p>
                    <p>
                        <strong>Đạo diễn: </strong>
                        <?php $tmp = $detail->filmCrewShow($detail->id, 2); 
                        $countTmp = count($tmp);
                        $j = 0;
                        ?>
                        @if($countTmp > 0)
                            @foreach($detail->filmCrewShow($detail->id, 2) as $value)
                            <?php $j++; ?>
                            <a href="{{ route('dao-dien', $value['slug']) }}" title="{{ $value['name'] }}">{{ $value['name'] }}</a><?php if($j < $countTmp && $j > 1) echo ", "; ?> 
                            @endforeach
                        @endif

                    </p>
                    <p>
                        <strong>Quốc gia: </strong>
                        
                        <?php $tmp = $detail->filmCountryName($detail->id ); 
                        $countTmp = count($tmp);
                        $i = 0;
                        ?>
                            @foreach($detail->filmCountryName($detail->id ) as $value)
                            <?php $i++; ?>
                            <a href="{{ route('cate', $value['slug']) }}" title="{{ $value['name'] }}">{{ $value['name'] }}</a><?php if($i < $countTmp) echo ", "; ?> 
                            @endforeach
                        </p>
                </div>
                <div class="mvici-right">
                    <p><strong>Thời lượng:</strong> {{ $detail->duration  ? $detail->duration : "Đang cập nhật" }}</p>

                    <p><strong>Chất lượng:</strong> <span class="quality">{{ Helper::showQuality($detail->quality) }}</span></p>

                    <p><strong>Năm sản xuất:</strong> {{ $detail->release_year  ? $detail->release_year : "Đang cập nhật" }}</p>

                    <p><strong>IMDb:</strong> {{ $detail->imdb }}</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-3">
        {{ $settingArr['w_ads_2'] }}
        </div>
        <div class="clearfix"></div>
    </div> 
</div>

<style type="text/css">
    .hero-unit {
        margin: 0 auto 0 auto;
    }
    
    .hero-unit video {
        width: 100%;
    }
     
</style>
<input type="hidden" id="video_url" value="{{ $detail->url }}">
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<input type="hidden" id="next_link" value="{{ $next_link }}">
<div class="content-kus" style="text-align: center; margin: 20px 0; padding: 15px; background-color: #FFF">
    <div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5"></div>
    <div class="clearfix"></div>
</div>
<style type="text/css">
.fb-comments, .fb-comments iframe[style], .fb-like-box, .fb-like-box iframe[style], .fb-comments span, .fb-comments iframe span[style], .fb-like-box span, .fb-like-box iframe span[style] 
{
       width: 100% !important;
}
.modal-sm{
    width: 350px !important;
}
</style>
<div id="errorModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Thông báo</h4>
      </div>
      <div class="modal-body">
       <p style="white-space:nowrap">Phim chưa được cập nhật</p> 
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="location.href='{{ route('home') }}'">Đóng</button>
      </div>
    </div>

  </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Thông báo</h4>
      </div>
      <div class="modal-body">
       <p style="white-space:nowrap">Tự động chuyển sang tập kế tiếp sau <span id="countdown2"><span id="countdown" style="font-weight:bold;color:#70b63d">10</span> giây</span>.</p> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="btnHuyChuyen">Tắt tự động chuyển</button>
        <button type="button" class="btn" style="background-color:#70b63d; border-color:#70b63d;color:#FFF" id="btnChuyen">Chuyển ngay</button>
      </div>
    </div>

  </div>
</div>
<style type="text/css">
    

</style>
@section('javascript_page')
<script type="text/javascript" src="{{ URL::asset('assets/plugins/jwplayer/jwplayer.js') }}" ></script>
<script>jwplayer.key = "dWwDdbLI0ul1clbtlw+4/UHPxlYmLoE9Ii9QEw==";</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#btnHuyChuyen').click(function(){
        $('#next_link').val('');
        $('#myModal').modal('hide');
    });
    $('#btnChuyen').click(function(){
        location.href=$('#next_link').val();
    });
});
var time_left = 10;
            var cinterval;
var sources = [
    <?php $count = count($urlVideo); ?>
     
    
    <?php $i = 0; ?>
    @foreach($urlVideo as $label => $video)
    <?php $i++; ?>
    {file: "{{ $video }}",
    type:'mp4',
    label: '{{ $label }}',    
    },
     @endforeach
     @if($count < 3)
     {file: "{{ $urlVideo['360p'] }}",
    type:'mp4',
    label: 'Auto',    
    }
     @endif];    
        var playerInstance = jwplayer("play-video");
        playerInstance.setup({
           sources: sources,                       
            width: "100%",
            autostart: true,
            aspectratio: "16:9",
            primary: "html5",
            controls: true,

        }); 
        playerInstance.onComplete(function(){
            if($('#next_link').val() != ""){
                $('#myModal').modal('show');             
                cinterval = setInterval('time_dec()', 1000);            
            }
        });
        playerInstance.onSetupError(function(){
            $('#errorModal').modal('show');
        });
       
 function time_dec(){
    time_left--;
    document.getElementById('countdown').innerHTML = time_left;
    if(time_left == 1){
        var originalstring = document.getElementById('countdown2').innerHTML;
        var newstring = originalstring.replace('seconds','second');
        document.getElementById('countdown2').innerHTML = newstring;
        //window.location.replace("http://mydomainhere.com");
        clearInterval(cinterval);
        location.href=$('#next_link').val();
    }
}
</script>
@endsection
