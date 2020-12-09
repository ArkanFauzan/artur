<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Account;
use App\Profile;

class MemberController extends Controller
{
    public function get_data(){
        // get detail account
        $account = Account::find(auth()->user()->id);
        // get account's profile picture (filename of picture = id)
        $img = Profile::firstOrCreate(['user_id'=>auth()->user()->id]);

        $profile = [
            'name'=>$account->name,
            'place'=>$account->place,
            'wa'=>$account->wa,
            'ig'=>$account->ig,
            // nama file foto profile
            'img'=>$img->id."."."$img->type",
        ];

        return response()->json(compact('profile'));
    }

    public function edit_profile(Request $request){
        // // get and update account detail
        // $account = Account::where('id', auth()->user()->id)->first();
        // $account->update([
        //     'name'=>$request->name,
        //     'place'=>$request->place,
        //     'wa'=>$request->wa,
        //     'ig'=>$request->ig,
        // ]);

        // update the extension of file
        $file = $request->file('file');
        $profile = Profile::where('user_id',auth()->user()->id)->first();
        $profile->update([
            'type'=> $file->getClientOriginalExtension()
        ]);

        // move the file to "profile" folder with uuid as file name
        $file->move('img/profile',$profile->id.".".$file->getClientOriginalExtension());

        return response()->json(['result'=>'success']);
    }
}
