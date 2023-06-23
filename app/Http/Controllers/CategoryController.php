<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\notifications;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminid =Auth::user()->id;
        $list= category::with(['categorys'=>function($q)use($adminid){
            $q->where('admin_id',$adminid);
        }])->get();
        $admin_notify = notifications::where('status',0)->get();
        return view('category.index',compact('list','admin_notify'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:category',
            'status' => 'required',
        ]);
      
        category::create($request->all());
      
        return redirect()->route('category.index')
                        ->with('success','category created successfully.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        return view('category.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
      
        $category->update($request->all());
      
        return redirect()->route('category.index')
                        ->with('success','category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        $category->delete();
    
        return redirect()->route('category.index')
                        ->with('success','category deleted successfully');
    }
}
