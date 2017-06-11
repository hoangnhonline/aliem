<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class FilmCountry extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'film_country';

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
    protected $fillable = ['film_id', 'country_id'];
     
    public static function deleteCountry( $object_id ){
        FilmCountry::where('film_id', $object_id)->delete();
    }
}
