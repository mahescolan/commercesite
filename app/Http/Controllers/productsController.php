<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use App\Models\products;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $admin_id = Auth::user()->id;
        $admin_name=Auth::user()->name;
        $data = Products::where('admin_id',$admin_id)->with('createdBy')->get();
        // return $data;
        return view('products.index',compact('data',"admin_name"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category= category::get();
        return view('products.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
   
    //  dd( $request);
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Quantity' => 'required',
            'status'=>'required',
            'category_id' => 'required',
            
            
        ]); 
        $admin_id = Auth::user()->id;
      

        $input = $request->all();
       
        if ($image = $request->file('image')) {
            
            $imageName = time().'.'.$image->extension();
       
            $destinationPathThumbnail = public_path('thumbnail');
            $img = Image::make($image->path());
           
            $img->resize(100, 100, function ($constraint){
                $constraint->aspectRatio();
            })->save($destinationPathThumbnail.'/'.$imageName);
         
            $destinationPath = public_path('images');
            $image->move($destinationPath, $imageName);
        }
      
        $input['admin_id']=$admin_id;
        $input['image']=$imageName;
      
        Products::create($input);
       
        return redirect()->route('products.index',compact('admin_id'))
                        ->with('success','Products created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(products $products,$id)
    {
        $products = Products::where('id',$id)->first();
        $admin_name =  Auth::user()->name;
        return view('products.show',compact('products','admin_name'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(products $products,$id)
    {
        $products= Products::where('id',$id)->first();
        $category= category::get();
     
        return view('products.edit',compact('products','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, products $products,$id)
    {
        $products= Products::where('id',$id)->first();
        
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
            'Quantity'=> 'required',
            'status'=>'required',
           'category_id' => 'required',
        ]);
        $admin_id = Auth::user()->id;
        $input = $request->all();
       
        if ($image = $request->file('image')){
            $imageName = time().'.'.$image->extension();
       
            $destinationPathThumbnail = public_path('thumbnail');
            $img = Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThumbnail.'/'.$imageName);
         
            $destinationPath = public_path('images');
            $image->move($destinationPath, $imageName);
        }
        $input['admin_id']=$admin_id;
        $input['image']=$imageName;
          $products->update($input);
          $e = Products::get();
        
        return redirect()->route('products.index',compact('admin_id'))
                        ->with('success','Products updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)

    {
    
        products::where('id',$id)->delete();
       
    
        return redirect()->route('products.index')
                        ->with('success','Products deleted successfully');
    }
    
    
}
