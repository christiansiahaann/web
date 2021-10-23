<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kandang extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_kandang';
    protected $table = 'kandang';
    protected $fillable = ['id_users','alamat','keterangan'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'created_at','updated_at','deleted_at'
    ];

    public static $rules = [
        'id_users' => 'required',
        'alamat' => 'required',
    ];
}
