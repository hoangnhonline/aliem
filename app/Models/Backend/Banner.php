<?php namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;


class Banner extends Model  {

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
    protected $fillable = ['name', 'slug', 'alias', 'bg_color', 'is_hot', 'status', 'icon_url', 'image_url', 'display_order', 'description', 'home_style', 'ads_url'];
    
    public function products()
    {
        return $this->hasMany('App\Models\Backend\SanPham', 'loai_id');
    }
    public function banners()
    {
        return $this->hasMany('App\Models\Backend\SanPham', 'loai_id');
    }
}
