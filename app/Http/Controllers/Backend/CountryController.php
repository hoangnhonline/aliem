<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Helper, File, Session, Auth;

class CountryController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {  
        
        $items = Country::orderBy('id')->get();        
        
        //$parentCate = Category::where('parent_id', 0)->where('type', 1)->orderBy('display_order')->get();
        
        return view('backend.country.index', compact('items'));
    }
    public function create()
    {         
        //$parentCate = Category::where('parent_id', 0)->where('type', 1)->orderBy('display_order')->get();

        return view('backend.country.create');
    }
    public function store(Request $request)
    {
       
        $dataArr = $request->all();
         
        $this->validate($request,[
            'name' => 'required',
            'slug' => 'required|unique:country,slug',
        ],
        [
            'name.required' => 'Bạn chưa nhập tên quốc gia',
            'slug.required' => 'Bạn chưa nhập slug',
            'slug.unique' => 'Slug đã được sử dụng.'
        ]);       
         
        
        $dataArr['created_user'] = Auth::user()->id;

        $dataArr['updated_user'] = Auth::user()->id;

        Country::create($dataArr);

        Session::flash('message', 'Tạo mới quốc gia thành công');

        return redirect()->route('country.index');
    }
    public function destroy($id)
    {
        // delete
        $model = Country::find($id);
        $model->delete();

        // redirect
        Session::flash('message', 'Xóa quốc gia thành công');
        return redirect()->route('country.index');
    }
    public function edit($id)
    {
        $detail = Country::find($id);

        
        return view('backend.country.edit', compact( 'detail'));
    }
    public function update(Request $request)
    {
        $dataArr = $request->all();
        
        $this->validate($request,[
            'name' => 'required',
            'slug' => 'required',
        ],
        [
            'name.required' => 'Bạn chưa nhập tên quốc gia',
            'slug.required' => 'Bạn chưa nhập slug',
        ]);       

        $model = Country::find($dataArr['id']);        

        $dataArr['updated_user'] = Auth::user()->id;

        $model->update($dataArr);

        Session::flash('message', 'Cập nhật quốc gia thành công');

        return redirect()->route('country.index');
    }
}