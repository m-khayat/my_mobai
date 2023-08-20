<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Mobile;
class CartController extends Controller
{
    public function index(){
    
        $carts = Cart::with('mobile')->where('user_id',auth()->user()->id)->get();
        //   $response['data'] = $carts;
        //    $response['message'] = "This is all contants";
           return  $carts;
      }
      
      
          public function store($id , Request $request)
       {
          $cart=Cart::where('mobile_id',$id)->where('user_id',Auth::user()->id)->first();
          if(!$cart)
          {
        $cart=new Cart();
        $cart->mobile_id=$id;
        $cart->user_id=auth()->user()->id;
        $cart->total = $request->total;
        $cart->save();
        $mobile=Mobile::find($id);
        $mobile->save();
          }
        if (isset($mobile)) {
        //   $response['data'] = $mobile ;
        //   $response['data'] = $cart;
        //   $response['message'] = "Success";
        //   return  response()->json($response,200);
        return  $cart;
          }
          else
        {
              $mobile = Mobile::find($id);
        if (isset($mobile)) 
          {
              
        return response()->json(['massage'=>'already added'],200);
          } 
        }
       }

       public function destroy($id)
    {
        $cart=Cart::where('mobile_id',$id)->where('user_id',Auth::user()->id)->first();
         
         $cart->delete();
         
}

        public function getTotalMobilePrice()
    {

            $total = Cart::join('mobiles', 'carts.mobile_id', '=', 'mobiles.id')
            ->where('carts.user_id', Auth::user()->id)
            ->sum('mobiles.price');


            return response()->json(['total' => $total]);
 }

}
