<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class FilmCrew extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'film_crew';

	 /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['film_id', 'crew_id', 'type'];
    
    public static function deleteFilmCrew( $object_id ){
        FilmCrew::where('film_id', $object_id)->delete();
    }

    public static function getFilmCrew( $object_id ){
        $arrReturn = [];
        $rs = FilmCrew::where('film_id', $object_id)->get();
        if( $rs ){
            foreach ($rs as $crew) {
                $arrReturn[$crew->type][] = $crew->crew_id;
            }
        }       
        return $arrReturn;
    }
}
