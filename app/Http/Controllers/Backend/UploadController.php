<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
class UploadController extends Controller
{
    public function tmpUpload(Request $request){
        $rsUpload = [];
        if ($request->ajax())
        {
        	$dataArr = $request->all();
            $date_dir = $dataArr['date_dir'] == 1 ? true : false;
            if($dataArr['file']){
                $rsUpload = Helper::uploadPhoto($dataArr['file'], $dataArr['folder'], $date_dir);
            }
        }
        return response()->json($rsUpload);
    }
    
}
