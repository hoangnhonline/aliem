<div id="top-user" class="header-user">    
@if(!Session::get('login'))
  <div class="top-user-content guest">
        <a href="#" class="visible-xs btn btn-successful btn-login login-by-facebook-popup" title="Login" rel="nofollow" >Login FB</a>
        <a href="#" class="hidden-xs btn btn-successful btn-login login-by-facebook-popup" title="Login" rel="nofollow" >Login with Facebook</a>
  </div>
  @else
  <div class="user-name">            

    <div class="user-name-link">       
      <ul>
        <li class="user-name-short"><span>Chào, {{Session::get('username')}}</span> <span class="caret"></span></li>        
      </ul>   

      <div class="user-name-box">                
        <ul class="user-ajax-customer">                      
          <li> <a href="{{route('kho-phim')}}" title="Kho phim của tôi"> Kho phim của tôi </a> </li>
          <li> <a href="{{route('user-logout')}}" title="Thoát tài khoản"> Thoát tài khoản </a> </li>          
        </ul>
      </div>

    </div>

    

  </div>
  @endif
</div>
<div id="search">
   <div class="search-content">
   	  <form action="/tim-kiem.html" method="GET" id="searchForm">
	      <input autocomplete="off" name="k" id="k" type="text" class="form-control search-input"
	         placeholder="Nhập từ khóa tìm kiếm..." value="{{ $tu_khoa or "" }}"/>
	      <a onclick="return search();" rel="nofollow" class="search-submit" href="javascript:void(0)" title="Tìm kiếm"><i
	         class="fa fa-search"></i></a>
      </form>
   </div>
</div>
<style type="text/css">

.header-user .user-name li { list-style: none; }
.header-user .user-name .user-name-box { display: none; }
.header-user .user-name .user-name-link > ul { margin-bottom: 0; padding: 5px; }

.header-user .user-name .user-name-link { margin-top: 19px; font-weight: bold; cursor: pointer; position: relative; }


.header-user .user-name .user-name-box { display: none; position: absolute; top: 30px; right: 0; border: 1px solid #ccc; padding: 10px 0; border-radius: 5px; background-color: #fff; min-width: 170px; z-index: 999; }
.header-user .user-name .user-name-box ul { padding-left: 10px; margin-bottom: 0; }

.header-user .user-name .user-name-link:hover .user-name-box  { display: block; }

.header-user .user-name .user-name-box ul li a { color: #333; cursor: pointer; display: block; font-weight: normal; line-height: 26px; }
.header-user .user-name .user-name-box ul li a:hover { color: #79C142; }


</style>

