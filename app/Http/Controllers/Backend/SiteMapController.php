<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\SiteMap;
use XmlParser;
use Storage;
use File, View;
use App\Models\Film;
use App\Models\FilmEpisode;
use App\Models\FilmCrew;
use App\Models\FilmCountry;
use App\Models\FilmCategory;
use App\Models\Crew;
use App\Models\Category;
use App\Models\Country;
use App\Models\Articles;
use App\Models\Tag;
use App\Models\TagObjects;

class SiteMapController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index(Request $request)
    {   
       $this->defaultLink();
       $this->category();
       $this->country();
       $this->tag();
       $this->crew();
       $this->articles();
       //$this->movies();
    }
    public function import(){
        $xml = XmlParser::load(public_path().'/sitemap.xml');
        $links = $xml->getContent();
        //var_dump("<pre>", $links);die;
        foreach($links->url as $link){
            $arr['url'] = $link->loc;
            $arr['changefreq'] = $link->changefreq;
            $arr['priority'] = $link->priority;
            echo $arr['url'];
            echo "<hr>";
            try{
                SiteMap::create($arr);
            }catch(\Exception $e){

            }
        }
    }
    public function movies(Request $request){
        set_time_limit(10000);

        $str_id = $request->id ? $request->id : null;        
      
        if($str_id){
            $idArr = explode(',', $str_id);
            $dataList = Film::whereIn('id', $idArr)->get(['id', 'slug', 'type']);
        }else{
            $dataList = Film::where('status', 1)->where('sitemap', 0)->get(['id', 'slug', 'type']);
        }
        if($dataList->count() > 0){
            foreach($dataList as $film){
                $url[] = 'http://phim1p.com/phim/'.$film->slug;
                $priority[] = '0.70';
                $url[] = 'http://phim1p.com/phim/'.$film->slug."/xem-phim.html";
                $priority[] = '0.60';
                if($film->type == 2){
                    $dataEpisode = FilmEpisode::where('film_id', $film->id)->orderBy('display_order')->get(['slug']);
                    if($dataEpisode){
                        foreach ($dataEpisode as $eps) {
                            $url[] = 'http://phim1p.com/phim/'.$film->slug."/".$eps->slug.".html";
                            $priority[] = '0.60';
                        }
                    }
                }
                
                //FilmCrew::deleteFilmCrew( $object_id );
                $tmpList = FilmCrew::where('film_id', $film->id)->whereIn('film_crew.type', ['1', '2'])->join('crew', 'film_crew.crew_id', '=', 'crew.id')->get(['crew.type as type','slug']);
                if(!empty($tmpList)){
                    foreach ($tmpList as $cr) {
                        $view = $cr->type == 1 ? "dien-vien" : "dao-dien";
                        $url[] = "http://phim1p.com/".$view."/".$cr->slug;
                        $priority[] = '0.80';
                    }
                }
                //FilmCountry::deleteCountry( $object_id );
                $tmpList = FilmCountry::where('film_id', $film->id)->join('country', 'film_country.country_id', '=', 'country.id')->get(['slug']);
                if(!empty($tmpList)){
                    foreach ($tmpList as $cr) {                            
                        $url[] = "http://phim1p.com/".$cr->slug;
                        $priority[] = '0.80';
                    }
                }
                //FilmCategory::deleteCategory( $object_id );
                $tmpList = FilmCategory::where('film_id', $film->id)->join('category', 'film_category.category_id', '=', 'category.id')->get(['slug']);
                if(!empty($tmpList)){
                    foreach ($tmpList as $cr) {                            
                        $url[] = "http://phim1p.com/".$cr->slug;
                        $priority[] = '0.80';
                    }
                }
                //TagObjects::deleteTags( $object_id, 1);
                $tmpList = TagObjects::where('object_id', $film->id)->where('tag_objects.type', 1)->join('tag', 'tag_objects.tag_id', '=', 'tag.id')->get(['slug']);
                
                if(!empty($tmpList)){
                    foreach ($tmpList as $cr) {                            
                        $url[] = "http://phim1p.com/tags/".$cr->slug;
                        $priority[] = '0.60';
                    }
                }  
                //update sitemap = 1
                $model = Film::find($film->id);
                $model->sitemap = 1;
                $model->save();
            }
        }
                
        
        if(!empty($url)){
            $this->writeSitemap($url, $priority);
        }
    }
    public function tag(){
        $dataList = Tag::where('type', 1)->get(['slug']);
        if(!empty($dataList)){
            foreach ($dataList as $data) {                
                $url[] = "http://phim1p.com/tags/".$data->slug;
                $priority[] = '0.60';
            }
        }
        $this->writeSitemap($url, $priority);
    }
    public function defaultLink(){
        $url = [
            'http://phim1p.com/',
            'http://phim1p.com/phim-theo-the-loai',
            'http://phim1p.com/phim-theo-quoc-gia',
            'http://phim1p.com/tin-tuc'            
        ]; 
        $priority = [
            '1.00',
            '0.60',
            '0.60',
            '0.60'            
        ];  
        $this->writeSitemap($url, $priority);      
    }
    public function category(){
        $dataList = Category::whereRaw('1')->get(['slug']);
        if(!empty($dataList)){
            foreach ($dataList as $data) {                
                $url[] = "http://phim1p.com/".$data->slug;
                $priority[] = '0.80';
            }
        }
        $this->writeSitemap($url, $priority);
    }
    public function articles(){
        $dataList = Articles::where('status', 1)->get(['id', 'slug']);
        if(!empty($dataList)){
            foreach ($dataList as $data) {                
                $url[] = "http://phim1p.com/tin-tuc/".$data->slug."-".$data->id.".html";
                $priority[] = '0.60';
            }
        }
        $this->writeSitemap($url, $priority);
    }
    public function country(){
        $dataList = Country::whereRaw('1')->get(['slug']);
        if(!empty($dataList)){
            foreach ($dataList as $data) {                
                $url[] = "http://phim1p.com/".$data->slug;
                $priority[] = '0.80';
            }
        }
        $this->writeSitemap($url, $priority);
    }
    public function crew(){
        $dataList = Crew::whereIn('type', [1,2])->get(['type','slug']);
        if(!empty($dataList)){
            foreach ($dataList as $data) {
                $view = $data->type == 1 ? "dien-vien" : "dao-dien";
                $url[] = "http://phim1p.com/".$view."/".$data->slug;
                $priority[] = '0.60';
            }
        }
        $this->writeSitemap($url, $priority);
    }    

    public function writeSitemap($urlArr, $priorityArr){
        foreach ($urlArr as $key => $url) {
            
            if($this->checkWrote($url) == false){
                var_dump($url);
                echo "<hr>";
                $data = [
                    'loc' => $url,
                    'priority' => $priorityArr[$key],
                    'changefreq' => 'hourly'
                ];    

                $fs = new File();

                $doc = new \DOMDocument();
                $doc->load(public_path().'/sitemap.xml');
                $fragment = $doc->createDocumentFragment();
                $fragment->appendXML(View::make('backend.sitemap.xml', compact('data')));
                $doc->documentElement->appendChild($fragment);
                $doc->save(public_path().'/sitemap.xml');

                // save to table sitemap
                $data['url'] = $data['loc'];
                unset($data['loc']);
                SiteMap::create($data);
            }
            
        }   
    }

    public function checkWrote($url){
        $rs = SiteMap::where('url', $url)->first();
        if($rs){
            return true;
        }else{
            return false;
        }
    }
    
}