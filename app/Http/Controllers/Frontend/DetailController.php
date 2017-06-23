<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cate;
use App\Models\Movies;
use App\Models\Tag;
use App\Models\TagObjects;
use App\Models\Film;
use App\Models\FilmEpisode;
use App\Models\Settings;
use App\Models\SystemMetadata;
use App\Models\KhoPhim;

use Helper, File, Session, DB;


class DetailController extends Controller
{    
    public static $parentCate = [];
    public static $countryArr = [];
    public static $countryArrKey = [];
    public static $categoryArrKey = [];   
    
    public function __construct(){

    }

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {   
        $id = $request->id;
        $detail = Movies::find($id);
        if($detail){
            $seo['title'] = $seo['description'] = $seo['keywords'] = $detail->title;
            return view('frontend.detail.index', compact('detail', 'seo'));        
               
        }else{
            return view('errors.404');
        }
        
    }
    public function getNextLink($detail, $episodeActive){
        $next_link = "";        
        $rs = FilmEpisode::where(['film_id' => $detail->id, 'display_order' => $episodeActive->display_order + 1])->first();
        if($rs){
            $next_link = route('detail-tap-phim', ['slugName' => $detail->slug, 'slugEpisode' => $rs->slug]);   
        }       
        return $next_link;    
    }
    public function landing(Request $request)
    {   
        $is_landing = 1;
        //var_dump($request->slugName, $request->slugEpisode);die;
        $settingArr = Settings::whereRaw('1')->lists('value', 'name');

        $tagSelected = $episodeActive = [];

        $cateArr = $cateActiveArr = $moviesActiveArr = [];       
        
        $slugName = $request->slugName;
        $slugEpisode = $request->slugEpisode ? $request->slugEpisode : "";

        $tmp = Film::where('slug', $slugName)->select('id')->first();


        $id = $tmp ? $tmp->id : -1;
        $detail = Film::where( 'id', $id )
                ->select('id', 'title', 'slug', 'description', 'quality', 'duration', 'image_url', 'poster_url', 'content', 'imdb', 'type', 'meta_id', 'release_year')                
                ->first();
       
        //https://lh3.googleusercontent.com/awv1HTJFUE5N-OuanegrmSr4EtPHYt1HqyBa1abaE6hj3S7utZyTk4k_eL-CF63QTTle4q4BHXo=m22
        if( $detail ){ 
            
            $episode = FilmEpisode::where('film_id', $id)->orderBy('display_order', 'asc')->get();

            if( $slugEpisode ){
                $episodeActive = FilmEpisode::where('film_id', $id)->where('slug', $slugEpisode)->orderBy('display_order', 'asc')->first();                

            }else{
                $episodeActive = FilmEpisode::where('film_id', $id)->orderBy('display_order', 'asc')->first();
            }
            
            $cate = $detail->filmCategory($id);
           
            $category_id = $cate[0]; 
            
            $cateDetail = Category::where('id', $category_id )->select('id', 'name', 'slug')->first();
            
            $relatedArr = Film::where('id', '<>', $id)
                        ->join('film_category', 'film_category.film_id', '=', 'film.id')
                        ->where('category_id', $category_id)
                        ->where('film.status', 1)
                        ->select('id', 'title', 'slug', 'image_url', 'quality')
                        ->orderBy('id', 'desc')

                        ->limit(12)
                        ->get();

            //tags
            $tmpArr = TagObjects::where( ['tag_objects.type' => 1, 'object_id' => $id] )
                        ->join('tag', 'tag.id', '=', 'tag_objects.tag_id')
                        ->select('name', 'slug')
                        ->get();
            
            if( $tmpArr->count() > 0 ){
                foreach ($tmpArr as $value) {                
                    $tagSelected[] = $value;
                }
            }
            
            $metadata = SystemMetadata::find( $detail->meta_id ); 

            $title = trim($metadata->meta_title) ? $metadata->meta_title : $detail->title;
            $description = trim($metadata->meta_description) ? $metadata->meta_description : Helper::crop_str($detail->content, 155);

            return view('home.landing', compact(
                'settingArr',
                'title',
                'tagSelected', 
                'relatedArr', 
                'detail',               
                'cateDetail',
                'episode',
                'episodeActive',
                'is_landing',
                'description'
                ));    
        }else{
            return view('errors.404');
        }
        
    }
    public function streaming(Request $request){

        $originalUrl = '';

        $encodeLink = $request->encodeLink;

        if( $encodeLink ){
            $decodeLink = Helper::decodeLink( $encodeLink );    

            if( strpos($decodeLink, 'zing.vn') > 0){

                $tmp = Helper::getVideoZing( $decodeLink );

                $originalUrl = $tmp['f480'] != '' ? $tmp['f480'] : $tmp['f360'];

            }
            if( strpos($decodeLink, 'google') > 0){   

                $tmp = Helper::getPhotoGoogle( $decodeLink);
                
                $originalUrl = (isset($tmp['720p']) && $tmp['720p'] != '' ) ? $tmp['720p'] : $tmp['360p'];
            }        
        }

        return $originalUrl;
    }

    public function getLink($decodeLink){

        $originalUrl = '';
       
        $tmp = [];
        if( $decodeLink ){            

            if( strpos($decodeLink, 'zing.vn') > 0){

                $tmp = Helper::getVideoZing( $decodeLink );

                //$originalUrl = $tmp['f480'] != '' ? $tmp['f480'] : $tmp['f360'];

            }
            if( strpos($decodeLink, 'google') > 0){   

                $tmp = Helper::getPhotoGoogle( $decodeLink);                
            }        
        }

        return $tmp;

    }

    public function ajaxMoviesInfo(Request $request){
        if( $request->ajax() ){

            $id = $request->movies_id;
            // get detail
            $detail = Film::find( $id );
            //get all country , get id to key
            $countryArr = Country::getListOrderByKey();
            //get all category, get id to key
            $categoryArr = Category::getListOrderByKey();
            
            $countryFilm = $detail->filmCountry( $id );
            $categoryFilm = $detail->filmCountry( $id );

            return view('home.detail.ajax-movies-info', compact( 'detail', 'countryArr', 'countryFilm', 'categoryArr', 'categoryFilm'));
        }
    }
    public function download(Request $request){
        
        set_time_limit(0); 
        ini_set('memory_limit', '512M'); 

        $url = $request->url;
        $detailExternal = Helper::getDetailVideoFromExternalSite( $url );
        $file = $detailExternal['video_url'];        
        $filename = $request->slug;

        header('Content-Description: File Download');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: no-cache');
        header('Expires: Mon, 1 Apr 1974 05:00:00 GMT');
        header("Content-type: video/mp4");
        header("Content-disposition: attachment; filename=$filename.mp4");
        ob_clean(); 
        flush(); 
        readfile($file);
        exit();

    }
   
}
