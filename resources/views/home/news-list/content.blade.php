@section('title'){{ $title }}@endsection
@section('site_description')<?php echo $meta_description == "" ? strip_tags($settingArr['site_description']) : str_replace('&nbsp;', ' ',strip_tags($meta_description)); ?>@endsection
@section('site_keywords'){{ $meta_keywords or $settingArr['site_keywords'] }}@endsection
@section('banner'){{ $settingArr['banner'] }}@endsection
@section('facebook_appid'){{ $settingArr['facebook_appid'] }}@endsection
@section('site_name'){{ $settingArr['site_name'] }}@endsection
@section('favicon'){{ Helper::showImage($settingArr['favicon']) }}@endsection
@section('logo'){{ Helper::showImage($settingArr['logo']) }}@endsection
<div id="bread">
   <ol class="breadcrumb">
      <li><a href="{{ URL::to('/')}}">Trang chủ</a></li>
      <li class="active">Tin tức</li>
   </ol>
</div>
<!--            <div style="text-align: left; margin: 10px 0;">-->
<!--                <ins data-revive-zoneid="75" data-revive-id="a5bfc1ebe0d32b0e7ec681a498616459"></ins>-->
<!--                <script async src="//digitaladsmedia.eu/vipx/www/delivery/asyncjs.php"></script>-->
<!--            </div>-->
<div class="news-block">
<div class="box news-content news-list">
   <div class="box-head news-list-head">
      <div class="nlh">TIN MỚI NHẤT</div>      
      <div class="clearfix"></div>
   </div>
   <div class="news-list-body">
      @if( $articlesArr->count() > 0 )
         @foreach( $articlesArr as $articles )
         <div class="news-list-item ">
            <a href="tin-tuc/{{ $articles->slug }}-{{ $articles->id }}.html"
               class="thumb"><img class="lazy"
               data-original="{{ Helper::showImage( $articles->image_url ) }}" title="{{ $articles->title }}"
               alt="{{ $articles->title }}"></a>
            <div class="info">
               <h2><a href="tin-tuc/{{ $articles->slug }}-{{ $articles->id }}.html"
                  title="{{ $articles->title }}">{{ $articles->title }}</a></h2>
               <p class="desc">{{ $articles->description }}</p>
               <p class="time">
                  <i class="fa fa-clock-o mr5"></i>{{ date('d/m/Y', strtotime($articles->created_at)) }}<span class="ml10">
                  <!--<i class="fa fa-eye mr5"></i>28</span>-->
               </p>
            </div>
            <div class="clearfix"></div>
         </div>
         @endforeach
      @endif
      <div id="pagination" style="margin-top:10px;">
         <nav>
            {{ $articlesArr->links() }}
         </nav>
      </div>
   </div>
</div>
<div class="news-sidebar">
   <!--<div class="box fanpage">
      <div class="fb-page" data-href="https://www.facebook.com/phim1p.com/" data-tabs="timeline"
         data-height="500px" data-small-header="false" data-adapt-container-width="true"
         data-hide-cover="false" data-show-facepile="true">
         <div class="fb-xfbml-parse-ignore">
            <blockquote cite="https://www.facebook.com/phim1p.com/"><a
               href="https://www.facebook.com/phim1p.com/">123Movies</a></blockquote>
         </div>
      </div>
   </div>-->
   @include('home.news-list.hot')
   <!--                    <ins data-revive-zoneid="72" data-revive-id="a5bfc1ebe0d32b0e7ec681a498616459"></ins>-->
   <!--                    <script async src="//digitaladsmedia.eu/vipx/www/delivery/asyncjs.php"></script>-->
</div>
<div class="clearfix"></div>
</div>