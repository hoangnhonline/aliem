@extends('frontend.layout')
@include('frontend.home.slider')
@section('bcrum')
<section class="breadcrumb-wrapper visible-md-block visible-lg-block">
   <div class="container">
      <ol class="breadcrumb">
         <li>
            <h1>Free JAVHD, Japanese Porn, Asian Sex Videos - phim18.fun</h1>
         </li>
      </ol>
   </div>
</section>
@endsection
@section('content')
@foreach($cateList as $cate)    
<div class="container">
   <div class="box">
      <div class="clearfix"></div>
      <h3 class="title">{!! $cate->name !!} <a href="{{ route('cate', $cate->slug) }}" title="{!! $cate->name !!}"><i class="glyphicon glyphicon-chevron-right"></i></a></h3>
      <div class="movie-list">
          @foreach($moviesArr[$cate->id] as $vid)
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
@endforeach
@endsection