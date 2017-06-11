<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Settings;
use App\Models\Country;
use App\Models\Category;
use App\Models\KhoPhim;
use Helper, File, Session;

class CustomerController  extends Controller
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
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function khoPhim(Request $request)
    {

         $cateDetail = (object) [];
        $customer_id = Session::get('userId');
        
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');
        
        $layout_name = "main-category";
        
        $page_name = "page-category";

        $cateArr = $cateActiveArr = $moviesActiveArr = [];

        $tu_khoa = $request->k;
        
        $kho_phim = 1;
        $is_search = 0;
        $moviesArr = Film::where('status', 1)
                ->join('kho_phim', 'film.id', '=', 'kho_phim.film_id') 
                ->where('customer_id', $customer_id)
                ->orderBy('kho_phim.created_at', 'desc')->paginate(30); 
        $title = "Kho phim của tôi";
        $cateDetail->name ="Kho phim của tôi";
        return view('home.cate', compact('settingArr', 'moviesArr', 'tu_khoa',  'kho_phim', 'layout_name', 'page_name', 'is_search', 'title', 'cateDetail'));
    }

    public function favorite(Request $request)
    {
        $film_id = $request->film_id;
        $customer_id = Session::get('userId');
        $status = $request->status;
        if($status == 1){
            KhoPhim::create(['film_id' => $film_id, 'customer_id' => $customer_id]);
        }else{
            KhoPhim::where('customer_id', $customer_id)->where('film_id', $film_id)->delete();
        }
        return json_encode(['message' => 'success']);
    }

}
