<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobile;
use Illuminate\Support\Facades\Auth;

class MobileController extends Controller
{
    
    public function index()
    {
        $mobiles = Mobile::all();
            return $mobiles;

    }

    public function show($id)
    {
        $mobile = Mobile::find($id);
        if (isset($mobile)) {
        return $mobile; 
    }
    }

    public function store(Request $request)
    {
        $mobile = new Mobile();
        $mobile->name = $request->name;
        $mobile->user_id = Auth::user()->id;
        $mobile->camera = $request->camera;
        $mobile->ram = $request->ram;
        $mobile->price = $request->price;
        $mobile->storage = $request->storage;
        $mobile->processor = $request->processor;
        $mobile->release_date = $request->release_date;
        $mobile->screen = $request->screen;
        $mobile->category_id = $request->category_id;
        
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationpath = public_path('/upload');
        $image->move($destinationpath , $name);
        $mobile->image = $name;

        $mobile->save();
        return $mobile;

      

    }
   
    public function update(Request $request , $id)
    {
    $mobile = Mobile::where('id' , $id)->first();
    if (isset($mobile))
    {
        if (isset($request->name)){
        $mobile->name = $request->name;}

        if (isset($request->camera)){
            $mobile->camera = $request->camera;}

         if (isset($request->ram)){
            $mobile->ram = $request->ram;}

         if (isset($request->price)){
            $mobile->price = $request->price;}
                    
        if (isset($request->storage)){
            $mobile->storage = $request->storage;}

        if (isset($request->processor)){
            $mobile->processor = $request->processor;}
                    
         if (isset($request->release_date)){
            $mobile->release_date = $request->release_date;}

        if (isset($request->screen)){
            $mobile->screen = $request->screen;}
                    
        if (isset($request->category_id)){
            $mobile->category_id = $request->category_id;}

        if (isset($request->image)) 
            { 
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationpath = public_path('/upload');
            $image->move($destinationpath , $name);
            $mobile->image = $name;
           }
           
        $mobile->save();
       return $mobile;
       

    }
   

    }
    public function destroy($id)
    {
         $mobile = Mobile::find($id);
         $mobile->delete();
         
 

}

public function MobileSearch(Request $request) 
{

    $data = $request->get('data');

    $mobile_search = Mobile::where('name', 'like', "%{$data}%")->get();
    if (count($mobile_search)){
        $response['data'] = $mobile_search;
       $response['message'] = "success";
       return response()->json([$response,200]);     
   }
   else
   {
    return response()->json(['message' => ' Data not found'], 404);
}

}

}
