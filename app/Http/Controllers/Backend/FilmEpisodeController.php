<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\FilmEpisode;
use App\Models\SystemMetadata;
use Helper, File, Session, Auth;

class FilmEpisodeController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {  
        $title = "";
        $film_id = $request->film_id;
        $detail = $metadata = [];
        $detailFilm = Film::find($film_id);

        $id = isset($request->id) ? $request->id : 0;
        if($id > 0){
            $detail = FilmEpisode::find( $id );

            if( $detail->meta_id > 0 ){
                $metadata = SystemMetadata::find( $detail->meta_id ); 
            }
        }      
        
        $title = isset($request->title) && $request->title != '' ? $request->title : '';
        
        $query = FilmEpisode::where('film_id', $film_id);
        
        if( $title != ''){
            $query->where('name', 'LIKE', '%'.$title.'%');
        }
        $items = $query->orderBy('display_order')->orderBy('id')->paginate(20);

        return view('backend.film-episode.index', compact('title', 'metadata', 'items', 'film_id', 'id', 'detailFilm', 'detail'));
    }
    public function updateOrder(Request $request){
        $display_orderArr = $request->display_order;
        $film_id = $request->film_id;
        if(!empty($display_orderArr)){
            foreach ($display_orderArr as $id => $display_order) {
                $model = FilmEpisode::find($id);
                $model->display_order = (int) $display_order;
                $model->save();
            }
        }
        Session::flash('message', 'Cập nhật thứ tự thành công');
        return redirect()->route('film-episode.index', $film_id);
    }
    public function create()
    {
        //$parentCate = Category::where('parent_id', 0)->where('type', 1)->orderBy('display_order')->get();

        return view('backend.film-episode.create');
    }
    public function store(Request $request)
    {
       
        $dataArr = $request->all();
        // var_dump("<pre>", $dataArr);die;
        $this->validate($request,[
            'name' => 'required',
            'slug' => 'required|unique:film_episode,slug,0,id,film_id,' . $dataArr['film_id']
        ],
        [
            'name.required' => 'Bạn chưa nhập tên tập phim',
            'slug.required' => 'Bạn chưa nhập slug',
            'slug.unique' => 'Slug đã được sử dụng.'
        ]);         
        
        if($dataArr['poster_url'] && $dataArr['poster_name']){
            
            $tmp = explode('/', $dataArr['poster_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('nghien.upload_path').$dataArr['poster_url'], config('nghien.upload_path').$destionation);
            
            $dataArr['poster_url'] = $destionation;
        } 

        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;
        $dataArr['display_order'] = $request->display_order ? $request->display_order : Helper::getDisplayOrder('film_episode', ['film_id' => $dataArr['film_id']]);
        $rs = FilmEpisode::create($dataArr);

        $object_id = $rs->id;

        $metaArr['meta_title'] = $dataArr['meta_title'];
        $metaArr['meta_description'] = $dataArr['meta_description'];
        $metaArr['meta_keywords'] = $dataArr['meta_keywords'];
        $metaArr['custom_text'] = $dataArr['custom_text'];
        
        $rsMeta = SystemMetadata::create( $metaArr );

        if( $rsMeta->id ){
            $modelFilmEpisode = FilmEpisode::find($object_id);
            $modelFilmEpisode->update(['meta_id' => $rsMeta->id]);
            
            $modelFilm = Film::find($dataArr['film_id']);
            $modelFilm->updated_episode_date = date('Y-m-d H:i:s');
            $modelFilm->save();
        }
        Session::flash('message', 'Thêm mới tập phim thành công');

        return redirect()->route('film-episode.index', ['film_id' => $dataArr['film_id']]);
    }
    public function destroy($id)
    {
        // delete
//var_dump($id);die;
	$model = FilmEpisode::find($id);
$film_id = $model->film_id;
        $model = FilmEpisode::where('id',$id)->delete();
//        $model->delete();

        // redirect
        Session::flash('message', 'Xóa tập phim thành công');
        return redirect()->route('film-episode.index', $film_id);
    }
    public function edit($id)
    {
        $detail = FilmEpisode::find($id);

        
        return view('backend.film-episode.edit', compact( 'detail'));
    }
    public function update(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[
            'name' => 'required',
            'slug' => 'required|unique:film_episode,slug,'.$dataArr['id'].',id,film_id,'.$dataArr['film_id'],
        ],
        [
            'name.required' => 'Bạn chưa nhập tên tập phim',
            'slug.required' => 'Bạn chưa nhập slug',
        ]);       
        
        if($dataArr['poster_url'] && $dataArr['poster_name']){
            
            $tmp = explode('/', $dataArr['poster_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('nghien.upload_path').$dataArr['poster_url'], config('nghien.upload_path').$destionation);
            
            $dataArr['poster_url'] = $destionation;
        } 

        $model = FilmEpisode::find($dataArr['id']);       

        $dataArr['updated_user'] = Auth::user()->id;

        $model->update($dataArr);
        
        if( $dataArr['meta_id'] > 0){

            $metaArr['meta_title'] = $dataArr['meta_title'];
            $metaArr['meta_description'] = $dataArr['meta_description'];
            $metaArr['meta_keywords'] = $dataArr['meta_keywords'];
            $metaArr['custom_text'] = $dataArr['custom_text'];
            $metaArr['id'] = $dataArr['meta_id'];
            $modelMetadata = SystemMetadata::find( $dataArr['meta_id'] );
            $modelMetadata->update( $metaArr );

        }else{
            $metaArr['meta_title'] = $dataArr['meta_title'];
            $metaArr['meta_description'] = $dataArr['meta_description'];
            $metaArr['meta_keywords'] = $dataArr['meta_keywords'];
            $metaArr['custom_text'] = $dataArr['custom_text'];
            
            $rsMeta = SystemMetadata::create( $metaArr );

            if( $rsMeta->id ){

                $modelFilmEpisode = FilmEpisode::find( $dataArr['id'] );
                $modelFilmEpisode->update(['meta_id' => $rsMeta->id]);

            }
        }
        $modelFilm = Film::find($model->film_id);
        $modelFilm->updated_episode_date = date('Y-m-d H:i:s');
        $model->save();
        Session::flash('message', 'Cập nhật tập phim thành công');

        return redirect()->route('film-episode.index', ['film_id' => $dataArr['film_id']]);
    }
}
