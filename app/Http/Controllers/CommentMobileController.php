<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class CommentMobileController extends Controller
{
    public function index($id)
    {
        $comments = Comment::with('users')->where('mobile_id',$id)->get();
     $response['data'] = $comments;
     $response['message'] = "This is all comments";
     return  response()->json($response,200);
    }
    public function store(Request $request)
    {
        $comment = new Comment();
		$comment->line = $request->line;
		$comment->user_id = Auth::user()->id;
		$comment->mobile_id = $request->mobile_id;

        $comment->save();
        $response['data'] = $comment;
        $response['message'] = "Added Successfully";
        return  response()->json($response,200);
        
    }
    public function update(Request $request , $id)
    {
    $comment = Comment::where('id' , $id)->first();
    if (isset($comment))
    {
      if (isset($request->line)){
        $comment->line = $request->line;}

        $comment->save();
        $response['data'] = $comment;
        $response['message'] = "Update Successfully ";
       return  response()->json($response,200);

    }
       $response['data'] = '';
       $response['message'] = "Error Not Found";
       return  response()->json($response,404);

    }
    public function destroy($id)
    {
         $comment = Comment::find($id);
  if (isset($comment)) {
        $comment->delete();
        $response['data'] = '';
        $response['message'] = "Deleted Successfully";
       return  response()->json($response,200);

    }
       $response['data'] = '';
       $response['message'] = "Error Not Found";
       return  response()->json($response,404); 
    
}
}
