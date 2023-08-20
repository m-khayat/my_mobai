<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
class SlidersController extends Controller
{
    public function index()
    {
     $sliders = Slider::all();
     $response['data'] = $sliders;
     $response['message'] = "This is all sliders";
     return  response()->json($response,200);
    }
    public function show($id)
    {
    $slider = Slider::find($id);
    if (isset($slider)) {
       $response['data'] = $slider;
       $response['message'] = "Success";
       return  response()->json($response,200);

    }
       $response['data'] = $slider;
       $response['message'] = "Error Not Found";
       return  response()->json($response,404);
    
    }
    public function store(Request $request)
    {
        $slider = new Slider();
		$slider->line = $request->line;
		$slider->read_link = $request->read_link;
		$slider->user_id = Auth::user()->id;


        $background = $request->file('background');
        $name = time().'.'.$background->getClientOriginalExtension();
        $destinationpath = public_path('/upload');
        $background->move($destinationpath , $name);
        $slider->background = $name;


        $slider->save();
        $response['data'] = $slider;
        $response['message'] = "Slider Added Successfully";
        return  response()->json($response,200);
        
    }
    public function update(Request $request , $id)
    {
    $slider = Slider::where('id' , $id)->first();
    if (isset($slider))
    {
      if (isset($request->background)){
         $background = $request->file('background');
        $name = time().'.'.$background->getClientOriginalExtension();
        $destinationpath = public_path('/upload');
        $background->move($destinationpath , $name);
        $slider->background = $name;}

      if (isset($request->line)){
        $slider->line = $request->line;}

      if (isset($request->read_link)){
        $slider->read_link = $request->read_link;}

        $slider->save();
        $response['data'] = $slider;
        $response['message'] = "Update Successfully ";
       return  response()->json($response,200);

    }
       $response['data'] = '';
       $response['message'] = "Error Not Found";
       return  response()->json($response,404);

    }
    public function destroy($id)
    {
         $slider = Slider::find($id);
  if (isset($slider)) {
        $slider->delete();
        $response['data'] = '';
        $response['message'] = "Slider Deleted Successfully";
       return  response()->json($response,200);

    }
       $response['data'] = '';
       $response['message'] = "Error Not Found";
       return  response()->json($response,404); 
    
}
}
