<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Register;
use App\Account;
use App\Profile;
use App\Transaction;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // show umkm who need verification
    public function index(){
        // get umkm that want to join
        $newUmkm = Register::orderBy('created_at','desc')->get();

        // change column "read" to 1 (true)
        // in front end, new umkm will have "read"= 0, and will display in bold style
        DB::table('registers')->select()->update(['read'=>'1']);

        // return all new umkm that not yet registered
        return response()->json(compact('newUmkm'),200);
    }

    // create umkm  account
    public function create(Request $request){
        // create account for new umkm after verified
        $umkm = Account::create([
            'name'=>ucwords($request->name),
            'place'=>ucwords($request->place),
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

    // get data umkm to login to dashboard umkm
    public function all_umkm(){
        $umkm = Account::select('id','name','email','place','wa','ig')->where('role','member')->get();
        return response()->json(compact('umkm'));
    }

    // get the overview profit and others
    public function overview(){
        $annual = Transaction::select(DB::raw('sum(profit) as profit, count(profit) as sold_item'))->where('updated_at','LIKE','%'.date('Y').'%')->first();
        $annualProfit = str_replace('.0','',$annual->profit);
        $annualSoldItem = $annual->sold_item;
        
        $monthly = Transaction::select(DB::raw('sum(profit) as profit, count(profit) as sold_item'))->where('updated_at','LIKE','%'.date('Y-m').'%')->first();
        $monthlyProfit = str_replace('.0','',$monthly->profit);
        $monthlySoldItem = $monthly->sold_item;

        return response()->json(compact('annualProfit','annualSoldItem','monthlyProfit','monthlySoldItem'));
    }
}
