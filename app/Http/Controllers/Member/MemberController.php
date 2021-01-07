<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Account;
use App\Profile;
use App\Product;
use App\Transaction;

class MemberController extends Controller
{
    public function get_data(){
        // get detail account
        $account = Account::find(auth()->user()->id);
        // get account's profile picture (filename of picture = id)
        $img = Profile::where('user_id',auth()->user()->id)->first();

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
        if ($request->file('file')==null) {
            return response('',200);
        }
        $file = $request->file('file');

        // condition = false, if the uploaded file is not an image
        if (getimagesize($file)===false) {
            return response(['errors'=>"The file must be an image"],422);
        }
        elseif($file->getSize()>4100000){
            return response(['errors'=>"The maximum file size is 4 MB"],422);
        }

        $profile = Profile::where('user_id',auth()->user()->id)->first();
        // delete the old file
        if (file_exists("img/profile/$profile->id.$profile->type")) {
            unlink("img/profile/$profile->id.$profile->type");
        }
        // update the extension of file
        $profile->update([
            'type'=> $file->getClientOriginalExtension()
        ]);

        // move the new file to "profile" folder with uuid as file name
        $file->move('img/profile',$profile->id.".".$profile->type);

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

    public function create_product(Request $request){
        request()->validate([
            'name'=> 'required|min:3|max:255',
            'description'=> 'required|min:3|max:1000',
            'file'=>'required|image|max:10000|'
        ]);

        $file= $request->file('file');
        $product = Product::create([
            'user_id'=>auth()->user()->id,
            'name'=> $request->name,
            'description'=> $request->description,
            'file_type'=>$file->getClientOriginalExtension()
        ]);
        
        // move the file to "product" folder with uuid as file name
        $file->move('img/product',$product->id.".".$product->file_type);

        return response()->json('sukses');
    }

    public function get_products(){
        $result = Product::where('user_id',auth()->user()->id)->get();;

        $product = [];
        foreach ($result as $value) {
            $product[] = [
                'id'=> $value->id,
                'name'=> $value->name,
                'description'=> $value->description,
                'img' => $value->id.".".$value->file_type
            ];
        }

        return response()->json(compact('product'));
    }

    public function show_product(Product $id, Request $request){
        if ($id->user_id != auth()->user()->id) {
            return response('',401);
        }

        $product = [
            'name'=> $id->name,
            'name'=> $id->name,
            'description'=> $id->description,
            'img' => $id->id.".".$id->file_type
        ];
        
        return response()->json(compact('product'));
    }

    public function edit_product(Product $id, Request $request){
        request()->validate([
            'name'=> 'required|min:3|max:255',
            'description'=> 'required|min:3|max:1000',
        ]);

        // if want to change product's picture
        if ($request->file('file')!=null) {
            $file = $request->file('file');
    
            // condition = false, if the uploaded file is not an image
            if (getimagesize($file)===false) {
                return response(['errors'=>['file'=>"The file must be an image"]],422);
            }
            elseif($file->getSize()>10100000){
                return response(['errors'=>['file'=>"The maximum file size is 10 MB"]],422);
            }
        }

        if ($id->user_id != auth()->user()->id) {
            return response('',401);
        }

        // delete the old file if user upload the new file
        if(isset($file) && file_exists("img/product/$id->id.$id->file_type")){
            unlink("img/product/$id->id.$id->file_type");
        }

        // update the product
        $id->update([
            'name'=> $request->name,
            'description'=> $request->description,
            'file_type'=>isset($file)?$file->getClientOriginalExtension():$id->file_type
        ]);

        if (isset($file)) {
            // move the file to "product" folder with uuid as file name
            $file->move('img/product',$id->id.".".$id->file_type);
        }

        return response()->json(compact('id'));
    }

    public function delete_product(Product $id){
        if ($id->user_id != auth()->user()->id) {
            return response('',401);
        }
        // delete the product image file
        if(file_exists("img/product/$id->id.$id->file_type")){
            unlink("img/product/$id->id.$id->file_type");
        }
        // delete the product from product table
        $id->delete();
        return 'sukses';
    }

    // list umkm & product for landing page umkm
    public function all_umkm(){
        $umkm = Account::select('id','name','place','ig')
                        ->where('role','member')->get();
                        
        return response()->json(compact('umkm'));
    }

    // list umkm & product for landing page umkm
    public function logo_umkm($id_umkm){
        // get file name of umkm logo
        $logo = Profile::where('user_id',$id_umkm)->first();

        $logo = $logo->id.'.'.$logo->type;
                        
        return response()->json(compact('logo'));
    }

    // list umkm & product for landing page umkm
    public function product_umkm($id_umkm){
        // get file name of umkm's products
        $products = Product::where('user_id',$id_umkm)->get();

        foreach ($products as $key => $product) {
            $products[$key] = [
                'img' => $product->id.'.'.$product->file_type,
                'name' => $product->name,
                'description'=> $product->description
            ];
        }

        return response()->json(compact('products'));
    }

    // create transaction for member
    public function transaction(Request $request){
        request()->validate([
            'product_name' => 'required|min:3',
            'net_price' => 'required|numeric|min:1000',
            'ongkir' => 'required|numeric|min:1000',
            'gross_price' => 'required|numeric|min:1000',
            'profit' => 'required|numeric|min:1000',
            'file' => 'required|image|max:2000|',
        ]);

        // store to database
        $transaction = Transaction::create([
            'user_id'=>auth()->user()->id,
            'product_name' => request()->product_name,
            'net_price' => request()->net_price,
            'ongkir' => request()->ongkir,
            'gross_price' => request()->gross_price,
            'profit' => request()->profit,
        ]);

        $file = request()->file('file');

        // store name file. filename = id (uuid).extension (file_type)
        $transaction->update([
            'file_type' => $file->getClientOriginalExtension()
        ]);

        // move uploaded file
        $file->move('img/transaction',$transaction->id.'.'.$transaction->file_type);
        return response()->json('sukses');
    }
}
