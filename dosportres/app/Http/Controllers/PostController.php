<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comentario;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::all();
        return view('post')->with("posts",$posts);
    }

    public function postAgregar(Request $request)
    {

        $post = new Post();
        $post->titulo = $request->input("titulo");
        $post->cuerpo = $request->input("contenido");
        $post->save();

        $posts = Post::all();
        return view('home')->with("posts",$posts);
    }

    public function postComentar(Request $request)
    {

        $comentario = new Comentario();

        $comentario->cuerpo_comentario = $request->input("comentario");
        $comentario->post_id = $request->input("post_id");
        $comentario->save();

        $posts = Post::all();

        return view('home')->with("posts",$posts);
    }

    public function getView($id)
    {

        $post = Post::find($id);
        $comentarios = Comentario::where("post_id",$id)->get();
        //dd($post->id);
       
        return view('view')->with("post",$post)->with("comentarios",$comentarios);
    }
}
