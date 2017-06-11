<?php namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;


class ParentCate extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'parent_cate';	

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
    protected $fillable = ['name', 'slug', 'alias', 'is_hot', 'status', 'display_order', 'description', 'meta_title', 'meta_description', 'meta_keywords', 'custom_text'];

    public function cates()
    {
        return $this->hasMany('App\Models\Backend\Cate', 'parent_id');
    }
}
