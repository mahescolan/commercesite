<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    public function productDetails(products $products,$id)
    {
    
        $products= Products::where('id',$id)->first();
        $relproducts=Products::all();
        // $relproducts = products::where('id','!=',$id)->where('id', $products->id)->get();
       
        return view('shops.productDetails', compact('products','relproducts'));
    }
   
}
