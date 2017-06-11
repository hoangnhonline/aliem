<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Helper, File, Session, Auth, DB;

class ReportController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {  
        
        $items = Report::whereRaw('1')
                    ->join('film', 'report.film_id', '=', 'film.id')
                    ->join('film_episode', 'report.episode_id', '=', 'film_episode.id')
                    ->groupBy('report.episode_id')
                    ->orderBy('created_at', 'DESC')
                    ->select('film_episode.name as episode_name', 'film.title as film_title', 'report.*', DB::raw('count(episode_id) as total_report'))
                    ->get();                
        return view('backend.report.index', compact('items'));
    }   
    public function fix(Request $request){
        $episode_id = $request->episode_id;
        Report::where('episode_id', '=', $episode_id)->forceDelete();
        Session::flash('message', 'Cập nhật thành công.');
        return redirect()->route('report.index');
    }
}