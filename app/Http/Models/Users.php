<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
class Users extends Model implements AuthenticatableContract
{
    use Authenticatable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $dateFormat = 'U';
    
}