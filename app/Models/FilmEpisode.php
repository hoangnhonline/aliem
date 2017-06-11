<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class FilmEpisode extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'film_episode';

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
    protected $fillable = ['name', 'slug', 'server_id', 'source', 'streaming_url', 'sub_url', 'created_user', 'updated_user', 'meta_id', 'film_id', 'poster_url', 'display_order'];    
    
}
