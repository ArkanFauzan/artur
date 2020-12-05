<?php

namespace App;
use App\Uuid;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use Uuid;
    
    protected $fillable = [
        'name','place','wa', 'email', 'ig','password'
    ];
}
