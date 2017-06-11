<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Helper, File, Session, Auth;

class CategoryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {  
        $items = Category::where('type', 1)->orderBy('display_order')->get();        
        
        $parentCate = Category::where(['parent_id' => 0, 'type' => 1])->orderBy('display_order')->get();
        
        return view('backend.category.index', compact( 'items', 'parentCate'));
    }

    public function ajaxListByParent(Request $request)
    {   
        $parent_id = isset($request->parent_id) ? $request->parent_id : 1;        

        $type = isset($request->type) ? $request->type : 'form';        
        
        $items = Category::where('parent_id', $parent_id)->orderBy('display_order')->get();        
        
        return view('backend.category.ajax-list-by-parent', compact( 'items', 'type' ));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
    public function create()
    {         
        $parentCate = Category::where('parent_id', 0)->where('type', 1)->orderBy('display_order')->get();

        return view('backend.category.create', compact('parentCate'));
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
            'slug' => 'required|unique:category,slug',
        ],
        [
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'slug.required' => 'Bạn chưa nhập slug',
            'slug.unique' => 'Slug đã được sử dụng.'
        ]);       
       
        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);  
        
        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;

        Category::create($dataArr);

        Session::flash('message', 'Tạo mới danh mục thành công');

        return redirect()->route('category.index');
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
        $detail = Category::find($id);

        $parentCateArr = Category::all();
        
        return view('backend.category.edit', compact( 'detail', 'parentCateArr' ));
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
            'slug' => 'required|unique:category,slug,'.$dataArr['id'],
        ],
        [
            'name.required' => 'Bạn chưa nhập tên danh mục',
            'slug.required' => 'Bạn chưa nhập slug',
        ]);       

        $dataArr['alias'] = Helper::stripUnicode($dataArr['name']);

        $model = Category::find($dataArr['id']);

        $dataArr['updated_user'] = Auth::user()->id;

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật danh mục thành công');

        return redirect()->route('category.index');
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
        $model = Category::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa danh mục thành công');
        return redirect()->route('category.index');
    }
}
