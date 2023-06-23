<?php

namespace App\Http\Controllers;
use App\Models\products;
use App\Models\carts;
use App\Models\admin;
use App\Models\orders;
use App\Models\order_details;
use App\Models\notifications;
use Illuminate\Support\Facades\Auth;



use Illuminate\Http\Request;

class ordersController extends Controller
{
    public function ordercode($length)
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);

    }
   
    public function orders()
    {
       //------------------CheckOut Insert----------------------------
   
        $order_code = $this->ordercode(6);
        $product = carts::where('admin_id',Auth::id())->get();
        
        $empty = carts::where('admin_id',Auth::id())->first();
        $id = orders::orderBy('id','DESC')->first();
        if($empty =='')
        {
            return back()->with('error','Select product to buy');
        }
        $order = orders::create([
           
            'order_code' =>$order_code,
            'admin_id' =>Auth::id(),
            'address'=>Auth::user()->address,
            'price'=>,
            'status' =>0,

        ]);
        foreach($product as $item)
        {
            if($order)
            {
             $order_details = order_details::create([
                'order_id' => $order_code,
                'product_id' =>$item->product_id,
                'quantity' =>$item->Quantity,
                'price' =>344,
             ]);
            }
            if($order_details)
            {
                carts::where('id',$item->id)->delete();
            }
        }
        $msg=$order_code.' New order has been recieved';
        notifications::create([
            'message' =>$msg,
            'from_id' =>Auth::id(),
            'to_id' =>1,
            'status' =>0,
        ]);
        return back()->with('checkout','Added successfully');
        return view('shops.orderManage');
    }
    public function order_details()
    {
        return view('shops.order_details');
    }
}      
          
    
  

