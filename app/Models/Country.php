<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Country extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'country';

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
    protected $fillable = ['name', 'description', 'slug', 'keywords', 'created_user', 'updated_user', 'status', 'is_hot', 'meta_title', 'meta_description', 'meta_keywords', 'custom_text'];
    
    public static function getListOrderByKey(){
        $arr = [];
        $tmp = Country::select('name', 'id', 'slug')->get();
        if( $tmp ){
            foreach ($tmp as $key => $value) {
                $arr[$value->id] = ['name' => $value->name, 'slug' => $value->slug];
            }
        }
        return $arr;
    }
}
