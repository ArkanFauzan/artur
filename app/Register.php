<?php

namespace App;
use App\Uuid;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use Uuid;

    protected $fillable = [
        'name','place','wa', 'email', 'ig','read'
    ];
}
