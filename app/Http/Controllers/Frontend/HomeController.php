<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Film;
use App\Models\Crew;
use App\Models\Tag;
use App\Models\TagObjects;
use App\Models\Settings;
use App\Models\Articles;
use App\Models\ArticlesCate;
use App\Models\FilmEpisode;
use App\Models\Privilege;
use App\Models\RolePrivilege;
use Helper, File, Session;

class HomeController extends Controller
{
    
    public static $parentCate = [];
    public static $countryArr = [];
    public static $countryArrKey = [];
    public static $categoryArrKey = [];    

    public function __construct(){
        
        self::$parentCate = Category::getParentCateList( 1 );

        if( self::$parentCate ){
            foreach (self::$parentCate as $key => $value) {
                self::$categoryArrKey[$value->id] = ['name' => $value->name, 'slug' => $value->slug];
            }
        }       

        self::$countryArr = Country::orderBy('display_order')->get();

        if( self::$countryArr ){
            foreach (self::$countryArr as $key => $value) {
                self::$categoryArrKey[$value->id] = ['name' => $value->name, 'slug' => $value->slug];
            }
        }
        view()->share(['parentCate' => self::$parentCate, 'countryArr' => self::$countryArr, '']);

    }
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {       
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');

        $layout_name = $page_name = "";

        $phimLeArr = $phimBoArr = $arrEpisode = [];
        $phimLeArr = Film::where('status', 1)->where('type', 1)                        
                                ->orderBy('id', 'desc')->limit(16)->get();
        $phimBoArr = Film::where('status', 1)->where('type', 2)                            
                        //->groupBy('film_id')                                                                     
                        ->orderBy('updated_episode_date', 'desc')->limit(16)->get();      

        if( $phimBoArr->count() > 0) {
            foreach( $phimBoArr as $phim)
            {
               // var_dump($phim->id);die;
                $tmp = FilmEpisode::where('film_id', $phim->id)->orderBy('display_order', 'desc')->orderBy('id', 'desc')->select('name')->first();
                if($tmp){
                    $arrEpisode[$phim->id] = $tmp->name;
                }
            }
        }
      //  var_dump("<pre>", $arrEpisode);die;
        //articles
        $articlesArr = Articles::where([ 'status' => 1, 'is_hot' => 1 ])->orderBy('id', 'desc')->select('id', 'slug', 'title', 'image_url')->limit(10)->get();

        $hotArr = Film::where([ 'status' => 1, 'slide' => 1 ])->orderBy('id', 'desc')->select('id', 'slug', 'title', 'image_url', 'description', 'slide', 'views', 'likes', 'imdb', 'order', 'push_top', 'poster_url', 'quality')->limit(10)->get();        

        return view('home.index', compact( 'settingArr', 'page_name', 'layout_name', 'hotArr', 'articlesArr', 'settingArr', 'phimLeArr', 'phimBoArr', 'arrEpisode'));
    }
    
    public function ajaxTab(Request $request){
        $arrEpisode = [];
        $type = $request->type ? $request->type : 'most-view';
        if($type == "kho-phim"){
            $customer_id = Session::get('userId');        
            
            $arr = Film::where('status', 1)
                    ->join('kho_phim', 'film.id', '=', 'kho_phim.film_id') 
                    ->where('customer_id', $customer_id)
                    ->orderBy('kho_phim.created_at', 'desc')->limit(16)->get(); 
        }else{
            $arr = Film::getFilmHomeTab( $type );
        }
        
        
        if( $arr->count() > 0) {
            foreach( $arr as $phim)
            {
                if($phim->type == 2){
                    $tmp = FilmEpisode::where('film_id', $phim->id)->orderBy('display_order', 'desc')->orderBy('id', 'desc')->select('name')->first();
                    if($tmp){
                        $arrEpisode[$phim->id] = $tmp->name;
                    }
                }
            }
        }
        
        return view('home.index.ajax-tab', compact('arr', 'arrEpisode'));
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function search(Request $request)
    {

        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        
        $layout_name = "main-category";
        
        $page_name = "page-category";

        $cateArr = $cateActiveArr = $moviesActiveArr = [];

        $tu_khoa = $request->k;
        
        $is_search = 1;

        $moviesArr = Film::where('alias', 'LIKE', '%'.$tu_khoa.'%')->orderBy('id', 'desc')->paginate(20);

        return view('home.cate', compact('settingArr', 'moviesArr', 'tu_khoa',  'is_search', 'layout_name', 'page_name' ));
    }

    public function cate(Request $request)
    {
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');

        $layout_name = "main-category";
        
        $page_name = "page-category";

        $cateArr = $cateActiveArr = $moviesActiveArr = [];

       
        $is_search = 0;
        $slug = $request->slug;
        $title = '';
        $cateDetail = (object) [];
        //var_dump($slug);die;
        if( $slug == 'phim-le' || $slug == 'phim-bo'){
            $type = $slug == 'phim-le' ? 1 : 2;
            $moviesArr = Film::where('status', 1)->where('type', $type)
                        ->orderBy('id', 'desc')->paginate(30);       
            $cateDetail->name = $slug == "phim-le" ? "Phim lẻ" : "Phim bộ";
        }elseif($slug == 'phim-theo-the-loai' || $slug == 'phim-theo-quoc-gia'){
            
           if($slug == 'phim-theo-the-loai'){
                 $moviesArr = Film::where('status', 1)
                ->join('film_category', 'id', '=', 'film_category.film_id')                
                ->groupBy('film_id')
                ->orderBy('id', 'desc')->paginate(30); 
           }else{
                $moviesArr = Film::where('status', 1)
                ->join('film_country', 'id', '=', 'film_country.film_id')                   
                ->groupBy('film_id')
                ->orderBy('id', 'desc')->paginate(30);       
           }   
            $cateDetail->name = $slug == "phim-theo-the-loai" ? "Phim theo thể loại" : "Phim theo quốc gia";
            
        }else{
            $cateDetail = Category::where('slug', $slug)->first();

            if( !$cateDetail){
                $cateDetail = Country::where('slug', $slug)->first();
                if(!$cateDetail){
                    return redirect()->route('home');
                }
                $moviesArr = Film::where('status', 1)
                ->join('film_country', 'id', '=', 'film_country.film_id')
                ->where('film_country.country_id', $cateDetail->id)
                ->groupBy('film_id')
                ->orderBy('id', 'desc')->paginate(30);        
            }else{
                 $moviesArr = Film::where('status', 1)
                ->join('film_category', 'id', '=', 'film_category.film_id')
                ->where('film_category.category_id', $cateDetail->id)
                ->groupBy('film_id')
                ->orderBy('id', 'desc')->paginate(30);        
            }
            $title = trim($cateDetail->meta_title) ? $cateDetail->meta_title : $cateDetail->name;
        }
        $arrEpisode = [];
        if($moviesArr->count() > 0){
            foreach( $moviesArr as $phim)
            {
                if($phim->type == 2){
                        $tmp = FilmEpisode::where('film_id', $phim->id)->orderBy('display_order', 'desc')->orderBy('id', 'desc')->select('name')->first();
                        if($tmp){
                            $arrEpisode[$phim->id] = $tmp->name;
                        }

                }
            }
        }
        $seo = Helper::seo();  
        //var_dump($seo);die;  
        return view('home.cate', compact('title', 'settingArr', 'is_search', 'moviesArr', 'cateDetail', 'layout_name', 'page_name', 'cateActiveArr', 'moviesActiveArr', 'seo', 'arrEpisode'));
    }

    public function tags(Request $request)
    {
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');

        $layout_name = "main-category";
        
        $page_name = "page-category";

        $cateArr = $cateActiveArr = $moviesActiveArr = [];
       
        $is_search = 0;
        $tagName = $request->tagName;

        $title = '';
        $cateDetail = (object) [];
        //var_dump($slug);die;
        
        $cateDetail = Tag::where('slug', $tagName)->first();
       
         $moviesArr = Film::where('status', 1)
        ->join('tag_objects', 'id', '=', 'tag_objects.object_id')
        ->where('tag_objects.tag_id', $cateDetail->id)
        ->where('tag_objects.type', 1)
        ->groupBy('object_id')
        ->orderBy('id', 'desc')->paginate(30);        
       
        $title = trim($cateDetail->meta_title) ? $cateDetail->meta_title : $cateDetail->name;
        $cateDetail->name = "Phim theo tags : ".'"'.$cateDetail->name.'"';
        

        return view('home.cate', compact('title', 'settingArr', 'is_search', 'moviesArr', 'cateDetail', 'layout_name', 'page_name', 'cateActiveArr', 'moviesActiveArr'));
    }
    
    public function daoDien(Request $request)
    {
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');

        $layout_name = "main-category";
        
        $page_name = "page-category";

        $cateArr = $cateActiveArr = $moviesActiveArr = [];
       
        $is_search = 0;
        $name = $request->name;

        $title = '';
        $cateDetail = (object) [];
        //var_dump($slug);die;
        
        $crew = $cateDetail = Crew::where('slug', $name)->first();
       // var_dump("<pre>", $crew);die;
         $moviesArr = Film::where('status', 1)
        ->join('film_crew', 'id', '=', 'film_crew.film_id')
        ->where('film_crew.crew_id', $cateDetail->id)
        ->where('film_crew.type', 2)
        ->groupBy('film_id')
        ->orderBy('id', 'desc')->paginate(30);        
       
        $title = trim($cateDetail->meta_title) ? $cateDetail->meta_title : $cateDetail->name;
        $cateDetail->name = "Phim của : ".'"'.$cateDetail->name.'"';
        $is_showDetail = 1;

        return view('home.cate', compact('title', 'settingArr', 'is_search', 'moviesArr', 'cateDetail', 'layout_name', 'page_name', 'cateActiveArr', 'moviesActiveArr', 'is_showDetail', 'crew'));
    }

    public function dienVien(Request $request)
    {
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');

        $layout_name = "main-category";
        
        $page_name = "page-category";

        $cateArr = $cateActiveArr = $moviesActiveArr = [];
       
        $is_search = 0;
        $name = $request->name;

        $title = '';
        $cateDetail = (object) [];
        //var_dump($slug);die;
        
         $cateDetail = Crew::where('slug', $name)->first();
        $crew = Crew::where('slug', $name)->first();
         $moviesArr = Film::where('status', 1)
        ->join('film_crew', 'id', '=', 'film_crew.film_id')
        ->where('film_crew.crew_id', $cateDetail->id)
        ->where('film_crew.type', 1)
        ->groupBy('film_id')
        ->orderBy('id', 'desc')->paginate(30);         
       
        $title = trim($cateDetail->meta_title) ? $cateDetail->meta_title : $cateDetail->name;
        $cateDetail->name = "Phim của : ".'"'.$cateDetail->name.'"';
        

        return view('home.cate', compact('title', 'settingArr', 'is_search', 'moviesArr', 'cateDetail', 'layout_name', 'page_name', 'cateActiveArr', 'moviesActiveArr', 'crew'));
    }

    public function newsList(Request $request)
    {
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        $layout_name = "main-news";
        
        $page_name = "page-news";

        $cateArr = $cateActiveArr = $moviesActiveArr = [];
       
        $cateDetail = ArticlesCate::where('slug' , 'tin-tuc')->first();
        
        $title = trim($cateDetail->meta_title) ? $cateDetail->meta_title : $cateDetail->name;
        $meta_description = trim($cateDetail->meta_description) ? $cateDetail->meta_description : $cateDetail->name;
        $meta_keywords = trim($cateDetail->meta_keywords) ? $cateDetail->meta_keywords : $cateDetail->name;
        $articlesArr = Articles::where('cate_id', 1)->orderBy('id', 'desc')->paginate(10);
        $hotArr = Articles::where( ['cate_id' => 1, 'is_hot' => 1] )->orderBy('id', 'desc')->limit(5)->get();
        return view('home.news-list', compact('title','settingArr', 'hotArr', 'layout_name', 'page_name', 'articlesArr', 'meta_description', 'meta_keywords'));
    }

    public function newsDetail(Request $request)
    {
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        $layout_name = "main-news";
        
        $page_name = "page-news";

        $id = $request->id;

        $detail = Articles::where( 'id', $id )
                ->select('id', 'title', 'slug', 'description', 'image_url', 'content', 'meta_title', 'meta_description', 'meta_keywords', 'custom_text', 'created_at')
                ->first();

        if( $detail ){
            $cateArr = $cateActiveArr = $moviesActiveArr = [];
        
            
            $title = trim($detail->meta_title) ? $detail->meta_title : $detail->title;

            $hotArr = Articles::where( ['cate_id' => 1, 'is_hot' => 1] )->where('id', '<>', $id)->orderBy('id', 'desc')->limit(5)->get();
            $content = strip_tags($detail->content);
            $description = trim($detail->meta_description) ? $detail->meta_description : Helper::crop_str($content, 155);

            return view('home.news-detail', compact('title', 'settingArr', 'hotArr', 'layout_name', 'page_name', 'detail', 'description'));
        }else{
            return view('erros.404');
        }     

        
    }

}
