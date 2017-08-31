<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentarios';

    public function post()
    {
        return $this->belongsTo('App\Post', 'id');
    }
}
