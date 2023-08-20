<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Mobile;
use App\Models\User;
class MobileViewController extends Controller
{
    public function index($id)
    {
        $view = View::where('mobile_id', $id)->where('user_id', Auth::user()->id)->first();
        if (!$view) {
            $view = new View();
            $view->mobile_id = $id;
            $view->user_id = auth()->user()->id;
            $view->save();
            $show = Mobile::find($id);
            $show->count_view++;
            $show->save();
            return response()->json(['massage' => 'view added'], 200);
        } else {
            return response()->json(['massage' => 'already added'], 404);
        }
    }
}
