<?php namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;


class Users extends Model  {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';	

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
    protected $fillable = ['full_name', 'email', 'password', 'role', 'status'];

    public function movies()
    {
        return $this->hasMany('App\Models\Backend\Movies', 'created_user');
    }
}
