<?php namespace App\Models\Backend;

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
    protected $fillable = ['title', 'slug', 'alias', 'parent_id', 'cate_id', 'is_hot', 'status', 'display_order', 'description', 'url', 'image_url', 'site_id', 'content', 'quality', 'duration', '','meta_title', 'meta_description', 'meta_keywords', 'custom_text'];
    
}
