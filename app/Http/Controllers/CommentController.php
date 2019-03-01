<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function createComment(Request $request){

        $data = $request -> json()->all();

        try{
        $comment = Comment::create([
        "user_id" => $data["user_id"],
        "post_id" => $data["post_id"],
        "body" => $data["body"],
        "imagen_url" => $data["imagen_url"]
        ]);

        return response()->json($comment , 201);

        }catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error" => $e->errorInfo,"codigo" => 500);
            return response()->json($respuesta, 500);
        }
    }

    public function updateComment(Request $request,$id){
        $data = $request->json()->all();
        $comment = Comment::find($id);

        $comment->body = $data["body"];
        $comment->imagen_url = $data["imagen_url"];

        $comment->save();

        return response()->json($comment,200);
    }

    public function deleteComment($id){
        try{
            $deleted = DB::delete('delete from comments where id = ?',[$id]);
            return response()->json("Comment borrado correctamente.",200);

        }catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error" => $e->errorInfo,"codigo" => 500);
            return response()->json($respuesta, 500);
        }

    }

    public function getComments(){
        $comment = Comment::all();
        return response()->json([$comment],200);
    }

    public function getCommentsByID($id){
        $comment = Comment::find($id);
        return response()->json($comment,200);
    }

    public function getCommentsByUserID($id){
        $comment = Comment::where(["user_id" => $id])->get();
        return response()->json($comment,200);
    }

    public function getCommentsByPostID($id){
        $comment = Comment::where(["post_id" => $id])->get();
        return response()->json($comment,200);
    }
}
