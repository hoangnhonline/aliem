@if( $arr->count() > 0)
   @foreach( $arr as $movies)    
    @if($movies->type == 1)
    <div data-movie-id="{{ $movies->id }}" class="ml-item">
        <a href="{{ route('landing', $movies->slug) }}"
           data-url="{{ route('movies-info', [ $movies->id ]) }}"
           class="ml-mask jt"
           title="{{ $movies->title }}">
              <span class="mli-quality">
                {{ Helper::showQuality($movies->quality) }}                        
              </span>
              <img data-original="{{ Helper::showImage( $movies->image_url )}}" title="{{ $movies->title }}" class="lazy thumb mli-thumb"
                 alt="{{ $movies->title }}">
              <span class="mli-info">
                 <p class="title">{{ $movies->title }}</p>
              </span>
        </a>
    </div>
    @endif
    @if($movies->type == 2)
    <div data-movie-id="{{ $movies->id }}" class="ml-item">
        <a href="{{ route('landing', $movies->slug) }}"
           data-url="{{ route('movies-info', [ $movies->id ]) }}"
           class="ml-mask jt"
           title="{{ $movies->title }}">
              @if(isset($arrEpisode[$movies->id]))
              <?php 
              $tmp = explode(" ", $arrEpisode[$movies->id]);
              ?>
              <span class="mli-eps">
              {{ $tmp[0] }} <i>{{ isset($tmp[1]) ? $tmp[1] : "" }}{{ $movies->duration ? "/".$movies->duration : "" }}</i>
              </span>
              @endif
              <img data-original="{{ Helper::showImage( $movies->image_url )}}" title="{{ $movies->title }}" class="lazy thumb mli-thumb"
                 alt="{{ $movies->title }}">
              <span class="mli-info">
                 <p class="title">{{ $movies->title }}</p>
              </span>
        </a>
    </div>
    @endif  
 @endforeach
@else
  <p style="text-align:center; padding-top:30px;color:#79C142">Đang cập nhật dữ liệu.</p>
@endif