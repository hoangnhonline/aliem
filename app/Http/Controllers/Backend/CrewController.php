<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Crew;

use Helper, File, Session, Auth;

class CrewController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {      
        $type = isset($request->type) ? $request->type : 0;

        $name = isset($request->name) && $request->name != '' ? $request->name : '';
        
        $query = Crew::whereRaw('1');

        if( $type > 0){
            $query->where('type', $type);
        }
        
        if( $name != ''){
            $query->where('name', 'LIKE', '%'.$name.'%');
        }
        $items = $query->orderBy('id', 'desc')->paginate(50);       
        
        
        return view('backend.crew.index', compact( 'items' , 'name', 'type' ));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create(Request $request)
    {
        return view('backend.crew.create');
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
           
            'name' => 'required',            
            'slug' => 'required|unique:crew,slug',
        ],
        [           
           
            'name.required' => 'Bạn chưa nhập tiêu đề',
            'slug.required' => 'Bạn chưa nhập slug',
            'slug.unique' => 'Slug đã được sử dụng.'
        ]);       
        
        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);
        
        if($dataArr['image_url'] && $dataArr['image_name']){
            
            $tmp = explode('/', $dataArr['image_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('nghien.upload_path').$dataArr['image_url'], config('nghien.upload_path').$destionation);
            
            $dataArr['image_url'] = $destionation;
        }        

        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;

        Crew::create($dataArr);        

        Session::flash('message', 'Tạo mới crew thành công');

        return redirect()->route('crew.index',['type' => $dataArr['type']]);
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

        $detail = Crew::find($id);

        return view('backend.crew.edit', compact('detail'));
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
        
        $this->validate($request,[   
            'name' => 'required',            
            'slug' => 'required|unique:crew,slug,'.$dataArr['id'],
        ],
        [           
            
            'name.required' => 'Bạn chưa nhập tiêu đề',
            'slug.required' => 'Bạn chưa nhập slug',
            'slug.unique' => 'Slug đã được sử dụng.'
        ]);       
        
        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);
        
        if($dataArr['image_url'] && $dataArr['image_name']){
            
            $tmp = explode('/', $dataArr['image_url']);

            if(!is_dir('uploads/'.date('Y/m/d'))){
                mkdir('uploads/'.date('Y/m/d'), 0777, true);
            }

            $destionation = date('Y/m/d'). '/'. end($tmp);
            
            File::move(config('nghien.upload_path').$dataArr['image_url'], config('nghien.upload_path').$destionation);
            
            $dataArr['image_url'] = $destionation;
        }
      

        $model = Crew::find($dataArr['id']);        

        $dataArr['updated_user'] = Auth::user()->id;

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật crew thành công');        

        return redirect()->route('crew.index', ['type' => $dataArr['type']]);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        // delete
        $model = Crew::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa crew thành công');
        return redirect()->route('crew.index');
    }
}
