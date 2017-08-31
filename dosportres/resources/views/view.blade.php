@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Visualizando Post</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                 
                    <form id="form-proveedor" name="form-proveedor" action="../comentar" method="post" enctype="multipart/form-data" class="horizontal-form">
                        @if ($errors->any())
                                        <div class="note note-danger">
                                            <h4 class="block">Debe Completar los siguientes campos:</h4>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                        @endif
              
                        <div class="row">
                            

                            <div class="col-md-12">
                              
                                <label>{{$post->titulo}}</label>
                            </div>

                            <div class="col-md-12">
                               
                                <label>{{$post->cuerpo}}</label>
                           
                            </div>
                            <div class="col-md-12 text-right">
                                <label>Comentarios:</label>
                                @if(count($comentarios) == 0)
                                    <p>Este post no tiene comentarios aun</p>
                                @else
                                    @foreach($comentarios as $comentario)
                                        <p>{{$comentario->cuerpo_comentario}}</p>
                                    @endforeach
                                @endif
                            </div>

                            <div class="col-md-12 text-center">
                                <label >Ingrese un comentario</label>
                                <input type="text" class="form-control" name="comentario">
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="col-md-12 text-center">
                            <br>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                            
                                
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
