<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Customer extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customers';

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
    protected $fillable = [      
      'full_name',
      'email',   
      'username',
      'password',
      'type',
      'last_login',
      'status',      
      'facebook_id',
      'image_url'
    ];    
}
