<?php namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;


class TagObjects extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tag_objects';	

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
    protected $fillable = ['tag_id', 'object_id', 'object_type'];  
    
}
