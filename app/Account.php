<?php

namespace App;
use App\Uuid;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use Uuid;
    
    protected $fillable = [
        'name','place','wa', 'email', 'ig','password','ecommerce'
    ];

    public function product(){
        return $this->hasMany(Product::class,'user_id','id');
    }

    public function profile(){
        return $this->hasOne(Profile::class,'user_id','id');
    }

    public function transaction(){
        return $this->hasMany(Transaction::class,'user_id','id');
    }
}
