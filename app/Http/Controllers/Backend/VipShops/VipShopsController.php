<?php

namespace App\Http\Controllers\Backend\VipShops;

use App\AddShop;
use App\Loyality;
use App\Http\Requests;
use App\PurchasesShop;
use Illuminate\Http\Request;
use File;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;

class VipShopsController extends Controller
{
    function ShopList(){

        $Addshop=AddShop::orderBy('id','asc')->get();
        return view('backend.vip-shops.index',compact('Addshop'));
    }
    public function create()
    {
        $loyalty = Loyality::where('status' , '1')->get();
        return view('backend.vip-shops.add' , compact('loyalty'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'base_image' => 'mimes:jpeg,jpg,png|required|dimensions:width=250,height=250',
            'status' => 'required|integer',
            'amount' => 'required|integer',
            'price' => 'required|integer',
            'type' => 'required|integer',
            'loyalty_type' => 'required|integer',
        ]);
        $add_shop=new AddShop();
        $add_shop->name=$request->name;
        $add_shop->status=$request->status;
        if (@$request->amount) {
            $add_shop->amount=$request->amount;
        }else {
            $add_shop->spin=$request->spin;
        }
        $add_shop->price=$request->price;
        $add_shop->type=$request->type;
        $add_shop->loyalty_type=$request->loyalty_type;
        $add_shop->save();

        if($request->hasFile('base_image')){
            $file = $request->file('base_image');
            $images = Image::make($file)->insert($file,'center');
            $pathImage = 'public/uploads/shop/';
            if (!file_exists($pathImage)){
                mkdir($pathImage, 0777, true);
                $name =time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();
                $images->save('public/uploads/shop/'.$name);
                $add_shop->base_image =  'public/uploads/shop/'.$name;
            }else{
                $name =time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();
                $images->save('public/uploads/shop/'.$name);
                $add_shop->base_image =  'public/uploads/shop/'.$name;
            }
            $add_shop->save();

        }
        Toastr::success('Item added successfully','Success');
        return redirect()->route('admin.shop_list');
    }
    public function edit($id)
    {
        $edit = AddShop::findOrFail($id);
        $loyalty = Loyality::where('status' , '1')->get();
        return view('backend.bonus.vip-shops.add', compact('edit' , 'loyalty'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'base_image' => 'mimes:jpeg,jpg,png|sometimes|nullable|dimensions:width=250,height=250',
            'status' => 'required|integer',
            'amount' => 'required|integer',
            'price' => 'required|integer',
            'type' => 'required|integer',
            'loyalty_type' => 'required|integer',
        ]);
        $add_shop = AddShop::findOrFail($id);
        $add_shop->name=$request->name;
        $add_shop->status=$request->status;
        $add_shop->price=$request->price;
        $add_shop->spin=$request->spin;
        $add_shop->amount=$request->amount;
        $add_shop->type=$request->type;
        $add_shop->loyalty_type=$request->loyalty_type;
        $add_shop->save();

        if($request->hasFile('base_image')){
            $file = $request->file('base_image');
            $images = Image::make($file)->insert($file,'center');
            $pathImage = 'public/uploads/shop/';
            if (!file_exists($pathImage)){
                mkdir($pathImage, 0777, true);
                $name =time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();
                $images->save('public/uploads/shop/'.$name);
                $add_shop->base_image =  'public/uploads/shop/'.$name;
            }else{
                $name =time() .'-'.uniqid().'.'.$file->getClientOriginalExtension();
                $images->save('public/uploads/shop/'.$name);
                if (file_exists($add_shop->base_image)) {
                    File::delete($add_shop->base_image);
                }
                $add_shop->base_image =  'public/uploads/shop/'.$name;
            }
            $add_shop->save();

        }
        Toastr::success('Item  updated successfully','Success');
        return redirect()->route('admin.shop_list');
    }
    public function destroy($id)
    {
        $data = AddShop::find($id);
        if (file_exists($data->base_image) && $data->base_image != 'public/uploads/shop/demo/mission-icon.png') {
            File::delete($data->base_image);
        }
        $data->delete();
        Toastr::success('Item deleted!','Success');
        return redirect()->back();
    }
    public function PurchaseItems()
    {
        $purchased_items           = PurchasesShop::with('add_shop','user')->get();
        return view('backend.vip-shops.purchasedItems',compact('purchased_items'));
    }
    public function status_change($id){
        $user = AddShop::find($id);
        if($user->status==1){
            $user->status = 0;
            $msg = 'Item disable successfully !';
        }else{
            $user->status = 1;
            $msg = 'Item enabled successfully !';
        }
        $user->save();
        Toastr::success($msg,'Success');
        return redirect()->back();
    }
}
