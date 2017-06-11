<div id="top-news">
   <div class="top-news">
      <ul class="nav nav-tabs" role="tablist">
         <li class="active"><a href="#tn-news" role="tab" data-toggle="tab" rel="nofollow">Bài viết mới</a></li>         
      </ul>
      <div class="top-news-content">
         <div class="tab-content">
            <div role="tabpanel" class="tab-pane in fade active" id="tn-news">
               <ul class="tn-news">
                  @if( $articlesArr->count() > 0 )
                     @foreach( $articlesArr as $articles )
                     <li>
                        <a href="tin-tuc/{{ $articles->slug }}-{{ $articles->id }}.html" title="{{ $articles->title }}" class="thumb news-thumb"
                           style="background-image:url({{ Helper::showImage( $articles->image_url ) }});"></a>
                        <div class="tnc-info">
                           <h4>
                              <a href="tin-tuc/{{ $articles->slug }}-{{ $articles->id }}.html"
                                 title="{{ $articles->title }}">{{ $articles->title }}</a>
                           </h4>
                        </div>
                        <div class="clearfix"></div>
                     </li> 
                     @endforeach                 
                  @endif
                  <li class="view-more">
                     <a href="/tin-tuc"> Xem thêm <i
                        class="fa fa-chevron-circle-right"></i></a>
                  </li>
               </ul>
            </div>          
         </div>
      </div>
   </div>
</div>