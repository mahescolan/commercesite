<?php

namespace App\Http\Controllers;
use App\Models\products;
use App\Models\carts;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Auth;




use Illuminate\Http\Request;

class shopController extends Controller
{
    public function index()
    {
        $products = products::all();
        
        
        return view('shops.shop',compact('products'));
    }
    public function cartList()
    {
        $products= carts::where('admin_id',Auth::id())->get();
      
      return view('shops.cart',compact('products'));
    }
    public function addToCart($product_id)
    {
       
        $admin_id = Auth::id();
        $products= carts::where('admin_id',$admin_id)->where('product_id',$product_id)->get();
    //  dd($products);
        if( count($products)>=1){
            // dd($products[0]['product_qty']);
            $product_qty = $products[0]['product_qty']+1;
            
            carts::where('admin_id',$admin_id)
                    ->where('product_id',$product_id)
                    ->update(['product_qty' => $product_qty]);
        }else{
            carts::create([
                'admin_id' => $admin_id,
                'product_id' => $product_id,
                'product_qty' => 1,
                
            ]);
    
        }

        session()->flash('success', 'Product is Added to Cart Successfully !');

        
        
        
       
        // return ($product->cartsPro->name);
       
     return back();
    }
    public function updateCart(Request $request)
    {
        $admin_id = Auth::id();
        
        $qty = (int)$request->input('qty');
        // return( $qty);
        $product_id = $request->input('product_id');
        carts::where('admin_id',$admin_id)
                    ->where('product_id',$product_id)
                    ->update(['product_qty' => $qty]);
        $total =  $request->price * $qty;
        return response()->json([
                'success' => true,
                'total'   => $total,
                'message' => 'Actions Saved Successfully',
			]);
           
    }
    public function removeCart($id)

    {
        if(("Are you sure want to remove?")){
    
        carts::where('id',$id)->delete();
       
        }
        return redirect()->route('cart.list')
                        ->with('success','Item Cart Remove Successfully');
    }

    // public function removeCart(Request $request,$id)
    // {
    //   dd($id);
    //         $product_id = $request->input('product_id');
    //         carts::where('product_id',$product_id)->delete();
      
        
    //     session()->flash('success', 'Item Cart Remove Successfully !');

    //     return redirect()->route('cart.list');
    // }

    public function clearAllCart()
    {
        carts::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
}