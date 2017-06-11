<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Crew;
use App\Models\FilmCountry;
use App\Models\FilmCategory;
use App\Models\FilmEpisode;
use App\Models\Tag;
use App\Models\TagObjects;
use App\Models\Film;
use App\Models\FilmCrew;
use App\Models\SystemMetadata;
use Helper, File, Session, DB, Auth;

class FilmController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public static $parentCate = array();
    public static $countryArr = array();

    public function __construct(){
        
        self::$parentCate = Category::getParentCateList( 1 );    

        self::$countryArr = Country::orderBy('display_order')->get();

        view()->share(['parentCate' => self::$parentCate, 'countryArr' => self::$countryArr ]);

    }
    public function index(Request $request)
    {  
        /*$tmp = Film::all();
        foreach ($tmp as $key => $value) {
            $id = $value->id;
            $content = html_entity_decode($value->content);
            $model = Film::find($id);
            $model->content = $content;
            $model->save();

        }
        */
        $status = isset($request->status) ? $request->status : 1;
        $title = isset($request->title) && $request->title != '' ? $request->title : '';
        
        $query = Film::where('film.status', $status);
        
        if( $title != ''){
            $query->where('alias', 'LIKE', '%'.$title.'%');
        }
        $query->join('users', 'users.id', '=', 'film.created_user');
        $items = $query->orderBy('film.id', 'desc')
        ->select(['film.id as film_id', 'title', 'image_url', 'film.created_at as time_created', 'description', 'users.full_name', 'film.status as status', 'sitemap'])
        ->paginate(20);
        
        return view('backend.film.index', compact('items', 'title', 'status'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {

        $crewArr = Film::filmCrew();
        
        $tagArr = Tag::where('type', 1)->get();

        return view('backend.film.create', compact( 'tagArr', 'crewArr'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  Request  $request
    * @return Response
    */
    public function store(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[
            'title' => 'required',
            'slug' => 'required|unique:film,slug'                       
        ],
        [           
            'title.required' => 'Bạn chưa nhập tên phim',
            'slug.required' => 'Bạn chưa nhập slug',                    
            'slug.unique' => 'Slug đã tồn tại'           
        ]);

        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;       
        
        $dataArr['updated_episode_date'] = date('Y-m-d H:i:s');
        
        $dataArr['alias'] = Helper::stripUnicode($dataArr['title']);
        
        if($dataArr['image_url'] && $dataArr['image_name']){
            
            $tmp = explode('/', $dataArr['image_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('nghien.upload_path').$dataArr['image_url'], config('nghien.upload_path').$destionation);
            
            $dataArr['image_url'] = $destionation;
        }

        if($dataArr['poster_url'] && $dataArr['poster_name']){
            
            $tmp = explode('/', $dataArr['poster_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('nghien.upload_path').$dataArr['poster_url'], config('nghien.upload_path').$destionation);
            
            $dataArr['poster_url'] = $destionation;
        }  

        if($dataArr['slide_url'] && $dataArr['slide_name']){
            
            $tmp = explode('/', $dataArr['slide_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('nghien.upload_path').$dataArr['slide_url'], config('nghien.upload_path').$destionation);
            
            $dataArr['slide_url'] = $destionation;
        }     

        $rs = Film::create($dataArr);

        $object_id = $rs->id;

        $this->processRelation($dataArr, $object_id, 'add');

        $metaArr['meta_title'] = $dataArr['meta_title'];
        $metaArr['meta_description'] = $dataArr['meta_description'];
        $metaArr['meta_keywords'] = $dataArr['meta_keywords'];
        $metaArr['custom_text'] = $dataArr['custom_text'];
        
        $rsMeta = SystemMetadata::create( $metaArr );

        if( $rsMeta->id ){
            $modelFilm = Film::find($object_id);
            $modelFilm->update(['meta_id' => $rsMeta->id]);
        }

        Session::flash('message', 'Tạo mới phim thành công');

        return redirect()->route('film.index');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
    //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function edit($id)
    {
        $tagSelected = $crewArr = $filmCategory = $filmCountry = [];
        $crewSelected = FilmCrew::getFilmCrew($id);

        $detail = Film::find($id);

        $crewArr = Film::filmCrew();
        
        $tagArr = Tag::where('type', 1)->get();

        $filmCategory = Film::filmCategory( $id );         

        $filmCountry = Film::filmCountry( $id );

        $metadata = SystemMetadata::find( $detail->meta_id );      
        
        $tagSelected = Film::filmTag( $id );

        return view('backend.film.edit', compact('crewArr', 'tagArr', 'tagSelected', 'detail', 'filmCategory', 'filmCountry', 'metadata', 'crewSelected'));
    }

    private function processRelation($dataArr, $object_id, $type = 'add'){
    
        if( $type == 'edit'){

            FilmCrew::deleteFilmCrew( $object_id );
            FilmCountry::deleteCountry( $object_id );
            FilmCategory::deleteCategory( $object_id );
            TagObjects::deleteTags( $object_id, 1);

        }
        // xu ly tags
        if( !empty( $dataArr['tags'] ) && $object_id ){
            foreach ($dataArr['tags'] as $tag_id) {
                TagObjects::create(['object_id' => $object_id, 'tag_id' => $tag_id, 'type' => 1]);
            }
        }
        // xu ly category
        if( !empty( $dataArr['category_id'] ) && $object_id ){
            foreach ($dataArr['category_id'] as $category_id) {
                FilmCategory::create(['film_id' => $object_id, 'category_id' => $category_id]);
            }
        }
        // xu ly country
        if( !empty( $dataArr['country_id'] ) && $object_id ){
            foreach ($dataArr['country_id'] as $country_id) {
                FilmCountry::create(['film_id' => $object_id, 'country_id' => $country_id]);
            }
        }
        // xu ly directors
        if( !empty( $dataArr['director'] ) && $object_id ){
            foreach ($dataArr['director'] as $crew_id) {
                FilmCrew::create(['film_id' => $object_id, 'crew_id' => $crew_id, 'type' => 2]);
            }
        }
        // xu ly actors
        if( !empty( $dataArr['actor'] ) && $object_id ){
            foreach ($dataArr['actor'] as $crew_id) {
                FilmCrew::create(['film_id' => $object_id, 'crew_id' => $crew_id, 'type' => 1]);
            }
        }
        // xu ly producers
        if( !empty( $dataArr['producer'] ) && $object_id ){
            foreach ($dataArr['producer'] as $tag_id) {
                FilmCrew::create(['film_id' => $object_id, 'crew_id' => $tag_id, 'type' => 3]);
            }
        }
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  Request  $request
    * @param  int  $id
    * @return Response
    */
    public function update(Request $request)
    {
        $dataArr = $request->all();
        $id = $dataArr['id'];
        
        $this->validate($request,[
            'title' => 'required',
            'slug' => 'required|unique:film,slug,'.$dataArr['id']                     
        ],
        [                      
            'title.required' => 'Bạn chưa nhập tên phim',
            'slug.required' => 'Bạn chưa nhập slug',                    
            'slug.unique' => 'Slug đã tồn tại',
            
        ]);       
        
        $dataArr['alias'] = Helper::stripUnicode($dataArr['title']);
        
        $dataArr['updated_user'] = Auth::user()->id;

        if($dataArr['image_url'] && $dataArr['image_name']){
            
            $tmp = explode('/', $dataArr['image_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('nghien.upload_path').$dataArr['image_url'], config('nghien.upload_path').$destionation);
            
            $dataArr['image_url'] = $destionation;
        }

        if($dataArr['poster_url'] && $dataArr['poster_name']){
            
            $tmp = explode('/', $dataArr['poster_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('nghien.upload_path').$dataArr['poster_url'], config('nghien.upload_path').$destionation);
            
            $dataArr['poster_url'] = $destionation;
        }

        if($dataArr['slide_url'] && $dataArr['slide_name']){
            
            $tmp = explode('/', $dataArr['slide_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('nghien.upload_path').$dataArr['slide_url'], config('nghien.upload_path').$destionation);
            
            $dataArr['slide_url'] = $destionation;
        }

        $model = Film::find( $id );

        $model->update($dataArr);

        $this->processRelation($dataArr, $dataArr['id'], 'edit');
        
        if( $dataArr['meta_id'] ){

            $metaArr['meta_title'] = $dataArr['meta_title'];
            $metaArr['meta_description'] = $dataArr['meta_description'];
            $metaArr['meta_keywords'] = $dataArr['meta_keywords'];
            $metaArr['custom_text'] = $dataArr['custom_text'];
            $metaArr['id'] = $dataArr['meta_id'];
            $modelMetadata = SystemMetadata::find( $dataArr['meta_id'] );
            $modelMetadata->update( $metaArr );
        }

        Session::flash('message', 'Cập nhật phim thành công');        

        return redirect()->route('film.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy( $id )
    {
        FilmCrew::deleteFilmCrew( $id );
        FilmCountry::deleteCountry( $id );
        FilmCategory::deleteCategory( $id );
        TagObjects::deleteTags( $id, 1);

        $model = Film::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa phim thành công');
        return redirect()->route('film.index');
    }
}
