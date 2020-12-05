<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Register;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrasiUMKM;

class RegisterController extends Controller
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
            'name'=> 'required|min:3|max:255',
            'place'=> 'required|min:3|max:255',
            'wa'=> 'required|min:10|regex:/^[0-9]+$/|max:15',
            'ig'=> 'required|min:3|max:255',
            'email'=> 'required|min:3|unique:registers,email|max:255',
        ]);

        $register_user = Register::create([
            'name'=>$request->name,
            'place'=>$request->place,
            'wa'=>$request->wa,
            'ig'=>$request->ig,
            'email'=>$request->email,
        ]);
        
        // Mail::to($register_user)->send(new RegistrasiUMKM($register_user));

        // return $request->all();
        return response()->json(null);
    }
}
