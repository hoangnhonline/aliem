@section('title'){{ $title }}@endsection
@section('site_description')<?php echo $description == "" ? strip_tags($settingArr['site_description']) : str_replace('&nbsp;', ' ',strip_tags($description)); ?>@endsection
@section('site_keywords'){{ $detail->meta_keywords or $settingArr['site_keywords'] }}@endsection
@section('banner'){{ $settingArr['banner'] }}@endsection
@section('facebook_appid'){{ $settingArr['facebook_appid'] }}@endsection
@section('site_name'){{ $settingArr['site_name'] }}@endsection
@section('favicon'){{ Helper::showImage($settingArr['favicon']) }}@endsection
@section('logo'){{ Helper::showImage($settingArr['logo']) }}@endsection
<div id="mv-info">
    <a href="{{ route('detail', $detail->slug) }}" title="{{ $detail->title }}" class="thumb mvi-cover" style="background-image: url({{ Helper::showImage( $detail->poster_url ) }})"></a>   
    @if( $episode && $detail->type == 2)
    <div id="list-eps">
        <div class="le-server">
            <div class="les-content">                
                @foreach( $episode as $ep )
                <a class="btn-eps {{ $ep->id == $episodeActive->id ? "active" : "" }} " id="eps-{{ $ep->id }}" 
                href="{{ route('detail-tap-phim', ['slugName' => $detail->slug, 'slugEpisode' => $ep->slug]) }}">{{ $ep->name }}</a>
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

                <div class="addthis_native_toolbox"></div>

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
                        $i = 0;
                        ?>
                        @if($countTmp > 0)
                            @foreach($detail->filmCrewShow($detail->id, 2) as $value)
                            <?php $i++; ?>
                            <a href="{{ route('dao-dien', $value['slug']) }}" title="{{ $value['name'] }}">{{ $value['name'] }}</a><?php if($i < $countTmp && $i > 1) echo ", "; ?> 
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