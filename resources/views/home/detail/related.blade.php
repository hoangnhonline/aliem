<!--related-->
<div class="movies-list-wrap mlw-related">
   <div class="ml-title ml-title-page">
      <h3 class="name">Có thể bạn muốn xem</h3>
   </div>
   <div class="movies-list movies-list-full">
      @if( $relatedArr->count() > 0)
         @foreach( $relatedArr as $movies)
         <div class="ml-item">
            <a href="{{ route('landing', $movies->slug) }}" class="ml-mask jt"
               data-url="{{ route('movies-info', [ $movies->id ]) }}"
               title="{{ $movies->title }}"
               >
               <span class="mli-quality">{{ Helper::showQuality($movies->quality) }}</span>
               <img data-original="{{ Helper::showImage( $movies->image_url )}}" title="{{ $movies->title }}" class="lazy thumb mli-thumb"
                  alt="{{ $movies->title }}">
               <span class="mli-info">
                 <p class="title">{{ $movies->title }}</p>
               </span>
            </a>
         </div>
         @endforeach
      @endif
      <script type="text/javascript">         
         $("img.lazy").lazyload({
             effect: "fadeIn"
         });
      </script>
   </div>
</div>
<!--/related-->