<?php

namespace App;
use App\Uuid;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Uuid;

    protected $fillable = [
        'name','description','file_type','user_id'
    ];
}
