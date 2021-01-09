<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Register;
use App\Account;
use App\Profile;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        // get umkm that want to join
        $newUmkm = Register::orderBy('created_at','desc')->get();

        // change column "read" to 1 (true)
        // in front end, new umkm will have "read"= 0, and will display in bold style
        DB::table('registers')->select()->update(['read'=>'1']);

        // return all new umkm that not yet registered
        return response()->json(compact('newUmkm'),200);
    }

    public function create(Request $request){
        // create account for new umkm after verified
        $umkm = Account::create([
            'name'=>$request->name,
            'place'=>$request->place,
            'wa'=>$request->wa,
            'ig'=>$request->ig,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        // create table "profile image for new umkm"
        Profile::create(['user_id'=>$umkm->id]);

        // delete umkm account from register table (not yet verified)
        Register::where('email',$request->email)->delete();

        return response()->json(['umkm'=>$umkm]);
    }
}
