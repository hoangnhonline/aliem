<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Report;

class ReportController  extends Controller
{
    public function report(Request $request){
        $film_id = $request->film_id;
        $episode_id = $request->episode_id;
        $ip_address = $_SERVER['REMOTE_ADDR'];
        try{
            Report::create(['film_id' => $film_id, 'ip_address' => $ip_address, 'episode_id' => $episode_id]);
        }catch(\Exception $e){

        }
    }
}

