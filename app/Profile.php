<?php

namespace App;
use App\Uuid;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use Uuid;

    protected $fillable = ['user_id','type'];

    public function user(){
        return $this->belongsTo(Account::class);
    }
}
