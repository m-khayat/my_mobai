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
        $category = new Category();
        $category->name = $request->name;
        $category->user_id = Auth::user()->id;
        $category->save();
        return $category;

      

    }
   
    public function update(Request $request , $id)
    {
    $category = Category::where('id' , $id)->first();
    if (isset($category))
    {
        if (isset($request->name)){
        $category->name = $request->name;}
        $category->save();
       return $category;
       

    }
   

    }
    public function destroy($id)
    {
         $category = Category::find($id);
         $category->delete();
         
 

}
}
