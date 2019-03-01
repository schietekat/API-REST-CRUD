<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(){
        $post = new Post();
        $post->title = "hola mundo";
        $post->body = "cuerpo del post";
        $post->imagen_url = "http://google.com";
        $post->user_id = 5;

        return response()->json($post,200);
    }

    public function createPost(Request $request){
        $data = $request->json()->all();
        try{
            $post = Post::create(
                [
                    "title" => $data["title"],
                    "body" => $data["body"],
                    "imagen_url" => $data["imagen_url"],
                    "user_id" => $data["user_id"]
                ]);
                return response()->json([$post],201);
        }catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error" => $e->errorInfo,"codigo" => 500);
            return response()->json($respuesta, 500);
        }

    }

    public function getPosts(){
        $posts = Post::all();
        return response()->json([$posts],200);
    }

    public function getPostsByID($id){
        $post = Post::find($id);
        return response()->json($post,200);
    }

    public function getPostsByUserID($id){
        $post = Post::where(["user_id" => $id])->get();
        return response()->json($post,200);
    }

    //Updates

    public function updatePost(Request $request,$id){
        $data = $request->json()->all();
        $post = Post::find($id);

        $post->title = $data["title"];
        $post->body = $data["body"];

        $post->save();

        return response()->json($post,200);
    }

    public function deletePost($id){
        try{
            $deleted = DB::delete('delete from posts where id = ?',[$id]);
            return response()->json("Post borrado correctamente.",200);

        }catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error" => $e->errorInfo,"codigo" => 500);
            return response()->json($respuesta, 500);
        }

    }

    //upload Image
    public function uploadFile(Request $request){
        try{
            $destinationPath = "/Cliente-servidor/proyect_1/storage/img";

            $fileName = str_random(10)."imagen.jpg";
            $request->file('imagen')->move($destinationPath,$fileName);
        }catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error" => $e->errorInfo,"codigo" => 500);
            return response()->json($respuesta, 500);
        }
    }
}
