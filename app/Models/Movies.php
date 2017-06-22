<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Movies extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'movies';

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
    protected $fillable = [ 'title', 
                            'duration', 
                            'image_url', 
                            'video_url', 
                            'cate_id', 
                            'slug'
                            ];   
    
}
