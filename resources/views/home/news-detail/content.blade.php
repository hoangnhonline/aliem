@section('title')<?php echo $title ?>@endsection
@section('site_description')<?php echo $description ? strip_tags($description) : strip_tags($settingArr['site_description']); ?>@endsection
@section('site_keywords'){{ $cateDetail->meta_keywords or $settingArr['site_keywords'] }}@endsection
@section('banner'){{ Helper::showImage($settingArr['banner']) }}@endsection
@section('favicon'){{ Helper::showImage($settingArr['favicon']) }}@endsection
@section('facebook_appid'){{ $settingArr['facebook_appid'] }}@endsection
@section('site_name'){{ $settingArr['site_name'] }}@endsection
@section('logo'){{ Helper::showImage($settingArr['logo']) }}@endsection
<div id="bread">
   <ol class="breadcrumb">
      <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
      <li><a href="{{ route('news-list')}}">Tin tức</a></li>
      <li class="active">{{ $detail->title }}</li>
   </ol>
</div>
<div class="news-block">
   <div class="box news-content news-view">
      <div class="box-content news-view-content">
         <div class="nvc-thumb" style="background-image: url({{ Helper::showImage( $detail->image_url ) }});"></div>
         <h1 class="title">{{ $detail->title }}</h1>
         <p class="time"><i class="fa fa-clock-o mr5"></i>{{ date('d/m/Y', strtotime($detail->created_at)) }}<span class="ml10">
           
            <i class="fa fa-comments mr5"></i><span id="fb-comment-count">0</span>
            </a>
         </p>
         <div class="block-social" style="padding-top: 15px; padding-bottom: 15px;">         
            <div class="addthis_native_toolbox"></div>
         </div>
        
         {!! $detail->content !!}
         
      </div>
      
      <div class="content-padding" style="border-top: 20px solid #e5e5e5;" id="comment">         
          <div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5"></div>
         
      </div>      
   </div>
   <div class="news-sidebar">
     
   @include('home.news-list.hot')

   </div>
   <div class="clearfix"></div>
</div>