<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class CrwVideo extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'crw_video';

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
                            'tag_id', 
                            'site_id',
                            'publish_status', 
                            'publish_site_id', 
                            'external_id'
                            ];   
    
}
