<?php

namespace App;
use App\Uuid;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use Uuid;
    protected $fillable = [
        // ongkir = ongkos kirim = shipping cost
        // need proof of payment, so need file upload (image), file name = id.file_type 
        'user_id','product_name','net_price','gross','discount','profit','ongkir','file_type'
    ];
}
