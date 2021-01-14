<?php

namespace App;
use App\Uuid;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Uuid;

    protected $fillable = [
        'name','price','description','ig','ecommerce','file_type','user_id'
    ];

    public function umkm(){
        return $this->belongsTo(Account::class,'user_id','id');
    }
}
