<div class="jtip-quality">
{{ Helper::showQuality($detail->quality) }}
</div>
<div class="jtip-top">
    <div class="jt-info jt-imdb">IMDb: {{ $detail->imdb }}</div>
    <div class="jt-info">{{ $detail->release_year }}</div>
    <div class="jt-info">{{ $detail->duration }}</div>
    <div class="clearfix"></div>
</div>
<p class="f-desc">{{ $detail->description }}...</p>

    <div class="block">Quốc gia:
         <?php $i = 0; 
                     $filmCountry = $detail->filmCountryName($detail->id);
                      $countCountry = count($filmCountry);
                     ?>
                      @if( !empty( $filmCountry ) )
                        @foreach ( $filmCountry as $country)  
                        <?php $i++; 
                        ?>                
                        
                        <a href="{{ route('cate', $country['slug']) }}" title="{{ $country['name'] }}">{{ $country['name'] }}</a>                         
                        {{ $i < $countCountry ? ", " : "" }}
                      
                      @endforeach
                    @endif
         </div>
    <div class="block">Thể loại:
        <?php $tmp = $detail->filmCategoryName($detail->id ); 
        $countTmp = count($tmp);
        $i = 0;
        ?>
            @foreach($detail->filmCategoryName($detail->id ) as $value)
            <?php $i++; ?>
            <a href="{{ route('cate', $value['slug']) }}" title="{{ $value['name'] }}">{{ $value['name'] }}</a><?php if($i < $countTmp) echo ", "; ?> 
            @endforeach

    </div>
<div class="jtip-bottom">
    <a href="{{ route('landing', $detail->slug) }}"
       class="btn btn-block btn-success"><i
            class="fa fa-play-circle mr10"></i>Xem phim</a>
        <!--<button onclick="favorite(15217,1)"
            class="btn btn-block btn-default mt10 btn-favorite-15217 add-favorite">
        Add to favorite    </button>-->
</div>
