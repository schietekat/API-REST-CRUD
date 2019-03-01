<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {

    // }

    public function createLike(Request $request){

        $data = $request -> json()->all();

        try{
        $like = Like::create([
        "user_id" => $data["user_id"],
        "post_id" => $data["post_id"],
        "comment_id" => $data["comment_id"]
        ]);
        return response()->json($like , 201);

        }catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error" => $e->errorInfo,"codigo" => 500);
            return response()->json($respuesta, 500);
        }
    }

    // public function updateLike(Request $request,$id){
    //     $data = $request->json()->all();
    //     $like = Like::find($id);

        // $like->user_id = $data["body"];
        // $like->imagen_url = $data["imagen_url"];

    //     $like->save();

    //     return response()->json($like,200);
    // }

    public function deleteLike($id){
        try{
            $deleted = DB::delete('delete from likes where id = ?',[$id]);
            return response()->json("like borrado correctamente.",200);

        }catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error" => $e->errorInfo,"codigo" => 500);
            return response()->json($respuesta, 500);
        }

    }

    public function getLikes(){
        $likes = Like::all();
        return response()->json([$likes],200);
    }

    public function getLikesByID($id){
        $likes = Like::find($id);
        return response()->json($likes,200);
    }

    public function getLikesByUserID($id){
        $likes = Like::where(["user_id" => $id])->get();
        return response()->json($likes,200);
    }

    public function getLikesByPostID($id){
        $likes = Like::where(["post_id" => $id])->get();
        return response()->json($likes,200);
    }

    public function getLikesByCommentID($id){
        $likes = Like::where(["comment_id" => $id])->get();
        return response()->json($likes,200);
    }
}
