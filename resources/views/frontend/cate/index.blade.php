@extends('frontend.layout')
@include('frontend.partials.meta')
@section('content')
<div class="container">
   <div class="box">
      <div class="clearfix"></div>
      <h3 class="title">{!! $cateDetail->name !!} <a href="{{ route('cate', [$cateDetail->slug]) }}" title="View more newest movies"><i class="glyphicon glyphicon-chevron-right"></i></a></h3>
      <div class="movie-list">        
          @foreach($moviesList as $vid)
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
      <div style="text-align:center">
          {{ $moviesList->links() }}
       </div>
   </div>
</div>    
@endsection