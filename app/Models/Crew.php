<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Crew extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'crew';

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
    protected $fillable = ['meta_id', 'name', 'slug', 'image_url', 'description', 'created_user', 'updated_user', 'type', 'alias'];
    
}
