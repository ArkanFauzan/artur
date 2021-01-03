<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        request()->validate([
            'email'=> 'required',
            'password'=> 'required'
        ]);
        
        $request->password =  bcrypt($request->password);

        if(Auth::attempt($request->only('email','password'))){
            // proteksi, hanya admin yang boleh login, login member melalui dashboard admin
            if (auth()->user()->role=='member') {
                auth()->logout();
                $error = "Email atau password salah";
                return response()->json(['status'=>402,'error'=>$error]);
            }
            return response()->json(['status'=>200]);
        }
        else{
            $error = "Email atau password salah";
            return response()->json(['status'=>402,'error'=>$error]);
        }
    }
}
