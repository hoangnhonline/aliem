@if(empty($seo))
    @if( $is_search == 1)
      @section('title'){{ "Kết quả tìm kiếm theo từ khóa '".$tu_khoa."'"  }}@endsection
    @else
      @section('title'){{ $title }}@endsection
    @endif
    @section('site_description'){{ $cateDetail->meta_description or $settingArr['site_description'] }}@endsection
    @section('site_keywords'){{ $cateDetail->meta_keywords or $settingArr['site_keywords'] }}@endsection
@else
    @section('title'){{ $seo['title'] }}@endsection
    @section('site_description'){{ strip_tags($seo['description']) }}@endsection
    @section('site_keywords'){{ $seo['keywords'] }}@endsection
@endif
@section('banner'){{ $settingArr['banner'] }}@endsection
@section('facebook_appid'){{ $settingArr['facebook_appid'] }}@endsection
@section('site_name'){{ $settingArr['site_name'] }}@endsection
@section('favicon'){{ Helper::showImage($settingArr['favicon']) }}@endsection
@section('logo'){{ Helper::showImage($settingArr['logo']) }}@endsection
<!--category-->
<div class="movies-list-wrap mlw-related">
@if(isset($crew) && $crew->description!='')  
  <div class="col-md-12" style="border :1px solid #ccc; padding:10px;margin-bottom:15px;border-radius:5px;background-color:#FFF">
    
      <div class="col-md-2" style="padding-left:0px">
        <img class="img-thumbnail" src="{{ Helper::showImage($crew->image_url) }}" width="214" />
      </div>
      <div class="col-md-10">
          <h2 style="font-size: 22px;">{{ $crew->name }}</h2>
          <p><?php echo $crew->description ?></p>
      </div>
      <div class="clearfix"></div>
  </div>
 @endif
  <div class="ml-title ml-title-page">
      <h1 class="name">
      {{ $is_search == 1 ? "Kết quả tìm kiếm theo từ khóa '".$tu_khoa."'" : $cateDetail->name }}
      </h1>      
      <div class="clearfix"></div>
   </div>
   
   <div id="pagination" style="margin: 0;">
      <nav>
         {{ $is_search == 1 ? $moviesArr->appends(['k' => $tu_khoa])->links() : $moviesArr->links() }}
      </nav>
   </div>
   <div class="movies-list movies-list-full">
      @if( $moviesArr->count() > 0)
         @foreach( $moviesArr as $movies)
         <div class="ml-item">
            <a href="{{ route('landing', $movies->slug) }}"

              data-url="{{ route('movies-info', [ $movies->id ]) }}"
                     class="ml-mask jt"
                     title="{{ $movies->title }}"
                     >
                @if($movies->type == 1)   
               <span class="mli-quality">{{ Helper::showQuality($movies->quality) }}</span>
               @endif
               @if($movies->type == 2)
                  @if(isset($arrEpisode[$movies->id]))
                      <?php 
                      $tmp = explode(" ", $arrEpisode[$movies->id]);
                      ?>
                      <span class="mli-eps">
                      {{ $tmp[0] }} <i>{{ isset($tmp[1]) ? $tmp[1] : "" }}{{ $movies->duration ? "/".$movies->duration : "" }}</i>
                      </span>
                      @endif
               @endif
               <img data-original="{{ Helper::showImage( $movies->image_url ) }}" title="{{ $movies->title }}" class="lazy thumb mli-thumb"
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
      <div class="clearfix"></div>
   </div>
   <div id="pagination">
      <nav>
         {{ $is_search == 1 ? $moviesArr->appends(['k' => $tu_khoa])->links() : $moviesArr->links() }}
      </nav>
   </div>
</div>
<!--/category-->
<div class="content-kus" style="text-align: center; margin: 20px 0; padding: 15px;">
  
</div>
<style type="text/css">
.pagination{
   margin: 0px !important;
   margin-bottom: 10px !important;
}
fieldset { 
    display: block;
    margin-left: 2px;
    margin-right: 2px;
    padding-top: 0.35em;
    padding-bottom: 0.625em;
    padding-left: 0.75em;
    padding-right: 0.75em;
    border: 2px groove ;
}
</style>
@section('javascript_page')
 <script type="text/javascript">
 function isCookieEnabled() {
       var e = navigator.cookieEnabled ? !0 : !1;
       return "undefined" != typeof navigator.cookieEnabled || e || (document.cookie = "testcookie", e = -1 != document.cookie.indexOf("testcookie") ? !0 : !1), e
   }
   if (!isCookieEnabled()) {
       $('#alert-cookie').css('display', 'block');
       $('body').addClass('off-cookie');
   }
    if (!jQuery.browser.mobile) {
        $('.jt').qtip({
            content: {
                text: function (event, api) {
                    $.ajax({
                        url: api.elements.target.attr('data-url'),
                        type: 'GET',
                        success: function (data, status) {
                            // Process the data

                            // Set the content manually (required!)
                            api.set('content.text', data);
                        }
                    });
                }, // The text to use whilst the AJAX request is loading
                title: function (event, api) {
                    return $(this).attr('title');
                }
            },
            position: {
                my: 'top left',  // Position my top left...
                at: 'top right', // at the bottom right of...
                viewport: $(window),
                effect: false,
                target: 'mouse',
                adjust: {
                    mouse: false  // Can be omitted (e.g. default behaviour),
                },
                show: {
                    effect: false
                }
            },
            hide: {
                fixed: true
            },
            style: {
                classes: 'qtip-light qtip-bootstrap',
                width: 320
            }
        });
    }
    $("img.lazy").lazyload({
        effect: "fadeIn"
    });
</script>
@endsection