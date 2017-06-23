@section('slider')
<section id="slider">
   <div id="head-carousel">
      <div class="is-carousel" style="z-index: 1;" id="metro-carousel" data-notauto=0 data-auto_timeout=5000 data-auto_duration=600>
         <div class="carousel-content">
            <?php $i = 0;?>
            @foreach($hotMovies as $vid)
            <?php $i++; ?>
            <div class="video-item">
            <?php 
            $isLar = ($i == 1 || ($i-1)%5 == 0 )? true : false;
            ?>               
             
               <div class="item-thumbnail">
                  <a href="{{ route('detail', [$vid->slug, $vid->id]) }}" title="{!! $vid->title !!}" >
                     <img src="{{ $vid->image_url }}" width="748" height="421" alt="{!! $vid->title !!}">
                     <div class="link-overlay glyphicon glyphicon-play-circle"></div>
                  </a>
                  <div class="item-head">
                     <h3><a href="{{ route('detail', [$vid->slug, $vid->id]) }}"  title="{!! $vid->title !!}">{{ $i }}=={!! $vid->title !!}</a></h3>
                     <span>
                     </span>
                  </div>
               </div>             
            </div>
            @endforeach                        
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
@endsection