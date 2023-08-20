<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
class CategoriesController extends Controller
{
    public function index()
    {
     $categories = Category::all();
        return $categories;

    }
    public function show($id)
    {
    $category = Category::find($id);
    if (isset($category)) {
      return $category; 

    }
    }
    public function store(Request $request)
    {
        if(Auth::user()->role=='admin'){
            $category = new Category();
            $category->name = $request->name;
    
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationpath = public_path('/upload');
            $image->move($destinationpath , $name);
            $category->image = $name;
    
            $category->user_id = Auth::user()->id;
            $category->save();
            return $category;
        }
       

      else{
            return"not authorized";
      }

    }
   
    public function update(Request $request , $id)
    {

        if(Auth::user()->role=='admin'){
            $category = Category::where('id' , $id)->first();
    if (isset($category))
    {
        if (isset($request->name)){
        $category->name = $request->name;}

        if (isset($request->image)) 
            { 
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationpath = public_path('/upload');
            $image->move($destinationpath , $name);
            $category->image = $name;
           }
           
        $category->save();
       return $category;
       

    }
        }
        
        else{
            return"not authorized";
        }
    }
    public function destroy($id)
    {

        if(Auth::user()->role=='admin'){
            $category = Category::find($id);
            $category->delete();
        }
        else{
            return"not authorized";
        }
        
         
 

}
}
