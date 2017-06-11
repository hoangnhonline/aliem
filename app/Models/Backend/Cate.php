<?php namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;


class Cate extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cate';	

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
    protected $fillable = ['name', 'slug', 'alias', 'parent_id', 'is_hot', 'status', 'display_order', 'description', 'meta_title', 'meta_description', 'meta_keywords', 'custom_text'];
    
}
