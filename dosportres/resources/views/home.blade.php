@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{asset('nuevopost')}}" class="btn btn-success">Nuevo Post</a>
                              
                            </div>
                           

                        </div>
                        </br>
                        @if (count($posts) == 0)
                            <label> Aun no hay posts en el sistema</label>
                        @else
                            <div class="row">
                                @foreach ($posts as $post)
                                <div class="col-md-12">
                                   
                                        <p>Titulo: {{ $post->titulo }}</p>
                                        <p>Contenido: {{ $post->cuerpo }}</p>
                                                      
                                  
                                    
                                </div>


                                <div class="col-md-6 text-right">
                                    <a href="post/{{$post->id}}" class="text-right">comentar</a>
                                </div>
                                @endforeach
                            </div>
                        @endif
                            
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
