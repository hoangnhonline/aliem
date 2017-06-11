<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'category';

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
    protected $fillable = ['parent_id', 'type', 'name', 'description', 'priority', 'slug', 'keywords', 'thumb', 'created_user', 'updated_user', 'status', 'is_hot', 'alias', 'meta_title', 'meta_description', 'meta_keywords', 'custom_text'];

    public static function getParentCateList( $type ){
        
        $parentCate = Category::where('parent_id', 0)
                    ->where('type', $type)
                    ->orderBy('display_order')
                    ->get();
                    
        return $parentCate;
    }

    public static function getListOrderByKey(){
        $arr = [];
        $tmp = Category::select('name', 'id', 'slug')->get();
        if( $tmp ){
            foreach ($tmp as $key => $value) {
                $arr[$value->id] = ['name' => $value->name, 'slug' => $value->slug];
            }
        }
        return $arr;
    }
    
}
