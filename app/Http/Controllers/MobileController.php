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

//     public function show($id)
// {
//     $mobile = Mobile::find($id);

//     if (isset($mobile)) {
//         $commentsCount = $mobile->comment()->count();

//         return response()->json([
//             'mobile' => $mobile,
//             'comments_count' => $commentsCount,
//         ]);
//     } else {
//         return response()->json([
//             'message' => 'Mobile not found.',
//         ], 404);
//     }
// }


// ...

public function show($id)
{
    $mobile = Mobile::find($id);

    if (isset($mobile)) {
        // Count the number of positive battery comments
        $commentsCount = $mobile->comment()->count();
        //battery
        $positiveBatteryCommentsCount = ($mobile->comment()->where('battery', 'positive')->count());
        $NegativeBatteryCommentsCount = ($mobile->comment()->where('battery', 'Negative')->count());
        $NeutralBatteryCommentsCount = ($mobile->comment()->where('battery', 'Neutral')->count());
        //Speed
        $positiveSpeedCommentsCount = ($mobile->comment()->where('speed', 'positive')->count());
        $NegativeSpeedCommentsCount = ($mobile->comment()->where('speed', 'Negative')->count());
        $NeutralSpeedCommentsCount = ($mobile->comment()->where('speed', 'Neutral')->count());
         //camera
         $positivecameraCommentsCount = ($mobile->comment()->where('camera', 'positive')->count());
         $NegativecameraCommentsCount = ($mobile->comment()->where('camera', 'Negative')->count());
         $NeutralcameraCommentsCount = ($mobile->comment()->where('camera', 'Neutral')->count());
         //memory
         $positivememoryCommentsCount = ($mobile->comment()->where('memory', 'positive')->count());
         $NegativememoryCommentsCount = ($mobile->comment()->where('memory', 'Negative')->count());
         $NeutralmemoryCommentsCount = ($mobile->comment()->where('memory', 'Neutral')->count());
        return response()->json([
            'mobile' => $mobile,
            'comments' => $commentsCount ,
            //battery
            'positive_battery_comments_count' => $positiveBatteryCommentsCount/$commentsCount,
            'nigative_battery_comments_count' => $NegativeBatteryCommentsCount /$commentsCount,
            'Neutral_battery_comments_count' => $NeutralBatteryCommentsCount /$commentsCount,
            //speed
            'positive_speed_comments_count' => $positiveSpeedCommentsCount/$commentsCount,
            'nigative_speed_comments_count' => $NegativeSpeedCommentsCount /$commentsCount,
            'Neutral_speed_comments_count' => $NeutralSpeedCommentsCount /$commentsCount,
            //camera
            'positive_camera_comments_count' => $positivecameraCommentsCount/$commentsCount,
            'nigative_camera_comments_count' => $NegativecameraCommentsCount/$commentsCount ,
            'Neutral_camera_comments_count' => $NeutralcameraCommentsCount/$commentsCount ,
             //memory
             'positive_memory_comments_count' => $positivememoryCommentsCount/$commentsCount,
             'nigative_memory_comments_count' => $NegativememoryCommentsCount /$commentsCount,
             'Neutral_memory_comments_count' => $NeutralmemoryCommentsCount /$commentsCount,

             //the finale rate
             'rate' => (($positiveBatteryCommentsCount+$positiveSpeedCommentsCount+$positivecameraCommentsCount+$positivememoryCommentsCount)/4)*100

        ]);
    } else {
        return response()->json([
            'message' => 'Mobile not found.',
        ], 404);
    }
}


    public function store(Request $request)
    {

        if(Auth::user()->role=='admin'){
            $mobile = new Mobile();
            $mobile->name = $request->name;
            $mobile->user_id = Auth::user()->id;
            $mobile->camera = $request->camera;
           // $mobile->rate = $request->rate;
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
              else{
                    return"not authorized";
              }
    }
   
    public function update(Request $request , $id)
    {

        if(Auth::user()->role=='admin'){
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
                     else{
                           return"not authorized";
                     }

      

    }
   

    }
    public function destroy($id)
    {

        if(Auth::user()->role=='admin'){
            $mobile = Mobile::find($id);
            $mobile->delete();
        }
                     else{
                           return"not authorized";
                     }

       
         
 

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
