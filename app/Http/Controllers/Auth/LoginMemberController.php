<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginMemberController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if (auth()->check()) {
            // login ke akun member hanya boleh oleh admin  (melalui dashboard admin)
            if (auth()->user()->role=='admin') {
                auth()->logout();
                Auth::loginUsingId($request->id);
                return response()->json('sukses');
            }
            return response('',401);
        }
        return response('',401);
    }
}
