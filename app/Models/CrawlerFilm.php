<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CrawlerFilm extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'crawler_film';

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
    protected $fillable = [
            'title', 
            'url', 
            'thumbnail_url', 
            'tag_id', 
            'site_id', 
            'is_publish', 
            'site_publish_id'
            ];
    
}
