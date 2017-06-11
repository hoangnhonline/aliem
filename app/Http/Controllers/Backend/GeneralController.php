<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use DB;
class GeneralController extends Controller
{
    public function updateOrder(Request $request){
        if ($request->ajax())
        {
        	$dataArr = $request->all();
        	$str_order = $dataArr['str_order'];        	
            $table = $dataArr['table'];        
            if( $str_order ){
            	$tmpArr = explode(";", $str_order);
            	$i = 0;
            	foreach ($tmpArr as $id) {
            		if( $id > 0 ){
            			$i++;
            			DB::table($table)
				        ->where('id', $id)				        
				        ->update(array('display_order' => $i));			
            		}
            	}
            }
        }        
    }
    
    public function getSlug(Request $request){
    	$strReturn = '';
    	if( $request->ajax() ){
    		$str = $request->str;
    		if( $str ){
    			$strReturn = str_slug( $str );
    		}
    	}
    	return response()->json( ['str' => $strReturn] );
    }

    public function getFilmExternal(Request $request){
        $arrReturn = [];
        if( $request->ajax() ){
            $url = $request->url;
            if( $url ){
                $arrReturn = Helper::getDetailVideoFromExternalSite($url);
                $arrReturn['slug'] = str_slug( $arrReturn['title'] );
            }
        }
        return response()->json( $arrReturn );
    }
}
