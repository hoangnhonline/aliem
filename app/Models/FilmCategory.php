<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class FilmCategory extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'film_category';

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
    protected $fillable = ['film_id', 'category_id'];
   
    public static function deleteCategory( $object_id ){
        FilmCategory::where('film_id', $object_id)->delete();
    }
}
