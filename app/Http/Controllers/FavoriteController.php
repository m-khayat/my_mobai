<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Models\Mobile;
class FavoriteController extends Controller
{
public function index(){
    
  $favorites = Favorite::with('mobile')->where('user_id',auth()->user()->id)->get();
    $response['data'] = $favorites;
     $response['message'] = "This is all favorites";
     return  response()->json($response,200);
}


    public function store($id)
 {
    $favorite=Favorite::where('mobile_id',$id)->where('user_id',Auth::user()->id)->first();
    if(!$favorite)
    {
  $favorite=new Favorite();
  $favorite->mobile_id=$id;
  $favorite->user_id=auth()->user()->id;
  $favorite->save();
  $mobile=Mobile::find($id);
  $mobile->save();
    }
  if (isset($mobile)) {
    $response['data'] = $mobile;
    $response['message'] = "Success";
    return  response()->json($response,200);
    }
    else
  {
        $mobile = Mobile::find($id);
  if (isset($mobile)) 
    {
        $favorite->delete();
  return response()->json(['massage'=>'deleted successfuly'],200);
    } 
  }
 }
}
