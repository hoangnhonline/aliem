<div class="header-logo">
   <a title="{{ $settingArr['site_name'] }}" href="{{ URL::to('/') }}" id="logo"></a>
</div>
<div class="mobile-menu"><i class="fa fa-reorder"></i></div>
<div class="mobile-search"><i class="fa fa-search"></i></div>
<div id="menu">
   <ul class="top-menu">
      <li class="">
         <a href="{{ URL::to('/') }}" title="Trang chủ">Trang chủ</a>
      </li>
     
         <li>
            <a href="{{ route('cate', 'phim-theo-the-loai') }}" title="QUỐC GIA">THỂ LOẠI</a>
            @if( !empty($parentCate) )
            <div class="sub-container" style="display: none">
               <ul class="sub-menu">
                  @foreach( $parentCate as $cate )
                  <li>                    
                     <a href="{{ route('cate', $cate->slug) }}" title="{{ $cate->name }}">{{ $cate->name }}</a>
                  </li>                  
                  @endforeach
               </ul>
               <div class="clearfix"></div>
            </div>
            @endif
         </li>
         <li>
            <a href="{{ route('cate', 'phim-theo-quoc-gia') }}" title="QUỐC GIA">QUỐC GIA</a>
            @if( !empty($countryArr) )
            <div class="sub-container" style="display: none">
               <ul class="sub-menu">
                  @foreach( $countryArr as $country )
                  <li>                    
                     <a href="{{ route('cate', $country->slug) }}" title="{{ $country->name }}">{{ $country->name }}</a>
                  </li>                  
                  @endforeach
               </ul>
               <div class="clearfix"></div>
            </div>
            @endif
         </li> 
     
      <li>
         <a href="{{ route('news-list') }}" title="Tin tức">Tin tức</a>
      </li>      
   </ul>
   <div class="clearfix"></div>
</div>
<!--<div id="top-user"></div>-->