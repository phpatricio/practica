<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comentario;
use Validator;

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

    public function postAgregar(Request $request) //agregar un nuevo post
    {
        //mensajes de los validadores
        //demostracion de usos
       $messages = [
            'required'    => 'Debe ingresar el  :attribute',
            'email.required'    => 'Debe ingresar el  correo',
            'numeric' => 'El :attribute debe solo contener números',
            'unique' => '¡El :attribute ya existe!',
            'max' => 'El :attribute no debe exeder los :max caracteres',
            'min' => 'El :attribute debe tener minimo :min caracteres',
            'confirmed' => 'Debe ingresar las 2 contraseñas iguales',
            'email' => 'Debe ingresar un correo vaildo',
        ];
        //validador de los input del formulario
        $validator = Validator::make($request->all(), [
            'titulo'             => 'required|max:50', //validamos que el titulo sea obligatorio y maximo de 50 caracteres
            'contenido' => 'required|max:150', //validamos que el cuerpo del post sea obligatiorio y maximo de 150 caracteres
            //'apellido_materno' => 'required|max:255',
 
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }
         else{

            $post = new Post();
            $post->titulo = $request->input("titulo");
            $post->cuerpo = $request->input("contenido");
            $post->save();

            $posts = Post::all();
            return view('home')->with("posts",$posts);
        }

    }

    public function postComentar(Request $request) //agregar un comentario a un post
    {

        //mensajes de los validadores
        //demostracion de usos
       $messages = [
            'required'    => 'Debe ingresar el  :attribute',
            'email.required'    => 'Debe ingresar el  correo',
            'numeric' => 'El :attribute debe solo contener números',
            'unique' => '¡El :attribute ya existe!',
            'max' => 'El :attribute no debe exeder los :max caracteres',
            'min' => 'El :attribute debe tener minimo :min caracteres',
            'confirmed' => 'Debe ingresar las 2 contraseñas iguales',
            'email' => 'Debe ingresar un correo vaildo',
        ];
        //validador de los input del formulario
        $validator = Validator::make($request->all(), [
           
            'comentario' => 'required|max:50', //validamos que el comentario del post sea obligatiorio y maximo de 50 caracteres
 
        ], $messages);

        //Si contiene errores se devuelve al formulario con todos los errores, de lo contrario guarda en la base de datos
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all)->withErrors($validator);
        }else{
            $comentario = new Comentario();
            $comentario->cuerpo_comentario = $request->input("comentario");
            $comentario->post_id = $request->input("post_id");
            $comentario->save();

            $posts = Post::all();

            return view('home')->with("posts",$posts);

        }

    }

    public function getView($id) //obtener la vista del post
    {

        $post = Post::find($id);
        $comentarios = Comentario::where("post_id",$id)->get();
        //dd($post->id);
       
        return view('view')->with("post",$post)->with("comentarios",$comentarios);
    }
}
