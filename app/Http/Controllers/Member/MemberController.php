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

    public function edit_profile_picture(Request $request){
        $file = $request->file('file');

        // condition = false, if the uploaded file is not an image
        if (getimagesize($file)===false) {
            return response(['errors'=>"The file must be an image"],422);
        }
        elseif($file->getSize()>4100000){
            return response(['errors'=>"The maximum file size is 4 MB"],422);
        }

        // update the extension of file
        $profile = Profile::where('user_id',auth()->user()->id)->first();
        $profile->update([
            'type'=> $file->getClientOriginalExtension()
        ]);

        // move the file to "profile" folder with uuid as file name
        $file->move('img/profile',$profile->id.".".$file->getClientOriginalExtension());

        return response()->json(['result'=>'success upload']);     
    }

    public function edit_profile(Request $request){
        request()->validate([
            'name'=> 'required|min:3|max:255',
            'place'=> 'required|min:3|max:255',
            'wa'=> 'required|min:10|regex:/^[0-9]+$/|max:15',
            'ig'=> 'required|min:3|max:255',
        ]);

       // get and update account detail
        $account = Account::where('id', auth()->user()->id)->first();
        $account->update([
            'name'=>$request->name,
            'place'=>$request->place,
            'wa'=>$request->wa,
            'ig'=>$request->ig,
        ]);

        return response()->json(['result'=>'success update']);
    }
}
