<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class KhoPhim extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'kho_phim';

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
    protected $fillable = ['film_id', 'customer_id'];
    
}
