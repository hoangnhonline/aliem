<?php namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;


class Tag extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tag';	

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
    protected $fillable = ['tag', 'slug', 'description', 'type', 'meta_title', 'meta_description', 'meta_keywords', 'custom_text'];
   
    public function objects()
    {
        return $this->hasMany('App\Models\Backend\TagObjects', 'tag_id');
    }
}
