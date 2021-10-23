<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Record extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id_record';
    protected $table = 'record';
    protected $fillable = ['id_sensor','value'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

    public static $rules = [
        'id_sensor' => 'required',
        'value' => 'required',
    ];
}
