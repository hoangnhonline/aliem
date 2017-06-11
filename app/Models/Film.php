<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FilmCountry;
use App\Models\FilmCategory;
use App\Models\FilmEpisode;
use App\Models\TagObjects;
use App\Models\CounterValues;

class Film extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'film';

	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['slide', 'meta_id', 'title', 'slug', 'alias', 'description', 'image_url', 'poster_url', 'duration', 'release_year', 'type', 'cinema', 'content', 'note', 'likes', 'views', 'updated_episode_date', 'status', 'imdb', 'top', 'order', 'expired', 'push_top', 'trailer', 'created_user', 'updated_user', 'quality', 'slide_url', 'sitemap'];
    
    

    public static function filmCategory( $id )
    {
        $arr = [];
        $rs = FilmCategory::where( 'film_id', $id )->lists('category_id');
        if( $rs ){
            $arr = $rs->toArray();
        }
        return $arr;
    }

    public static function filmCategoryName( $id )
    {
        $arr = [];
        $rs = FilmCategory::where( 'film_id', $id )
                ->join('category', 'category.id', '=', 'film_category.category_id')
                ->select('name', 'id', 'slug')->get();
        if( $rs ){
            $arr = $rs->toArray();
        }
        return $arr;
    }
    public static function filmCrewShow( $id, $type)
    {
        $arr = [];
        $rs = FilmCrew::where( 'film_id', $id )
                ->join('crew', 'crew.id', '=', 'film_crew.crew_id')
                ->where('film_crew.type', $type)
                ->select('name', 'id', 'slug')->get();
        if( $rs ){
            $arr = $rs->toArray();
        }
        return $arr;
    }
    
    public static function filmCountry( $id )
    {
        $arr = [];
        $rs = FilmCountry::where( 'film_id', $id )->lists('country_id');
        if( $rs ){
            $arr = $rs->toArray();
        }
        return $arr;
    }

    public static function filmCountryName( $id )
    {
        $arr = [];
        $rs = FilmCountry::where( 'film_id', $id )
                ->join('country', 'country.id', '=', 'film_country.country_id')
                ->select('name', 'id', 'slug')->get();
        if( $rs ){
            $arr = $rs->toArray();
        }
        return $arr;
    }
    public static function filmTag( $id )
    {
        $arr = [];
        $rs = TagObjects::where( ['type' => 1, 'object_id' => $id] )->lists('tag_id');
        if( $rs ){
            $arr = $rs->toArray();
        }
        return $arr;
    }

    public static function filmCrew(){

        $crewArr = [];

        $tmpCrew = Crew::all();

        foreach( $tmpCrew as $crew ){
            $crewArr[$crew->type][] = $crew;
        }
        return $crewArr;
    }
    public function episodes()
    {
        return $this->hasMany('App\Models\FilmEpisode', 'film_id');
    }

    public static function getFilmHomeTab($type){

        $arr = [];

        if($type == "most-view"){
            $arr = CounterValues::where('day_value','>', 0)
                ->join('film', 'film.id' , '=', 'film_id')
                ->orderBy('day_value', 'desc')->limit(16)->get();
        }elseif($type == "top-imdb"){
            $arr = Film::where('status', 1)                                    
                            ->orderBy('imdb', 'desc')->limit(16)->get();
        }else{ // phim moi cap nhat
            $arr = Film::where('status', 1)                                    
                            ->orderBy('updated_episode_date', 'desc')->limit(16)->get();
        }

        return $arr;
    }
}
