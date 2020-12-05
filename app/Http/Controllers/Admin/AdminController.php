<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Register;
use App\Account;

class AdminController extends Controller
{
    public function index(){
        $newUmkm = Register::orderBy('created_at','desc')->get();
        return response()->json(compact('newUmkm'),200);
    }

    public function create(Request $request){
        $umkm = Account::create([
            'name'=>$request->name,
            'place'=>$request->place,
            'wa'=>$request->wa,
            'ig'=>$request->ig,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);

        Register::where('email',$request->email)->delete();

        return response()->json(['umkm'=>$umkm]);
    }
}
