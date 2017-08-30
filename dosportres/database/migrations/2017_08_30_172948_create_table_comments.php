<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentarios', function (Blueprint $table) {
    
            $table->increments('id');
            $table->string('cuerpo_comentario');
            $table->integer('post_id')->unsigned(); //hacemos que no tenga signo negativo
            $table->foreign('post_id')->references('id')->on('posts'); //hacemos la llave foranea para relaconar cada post con sus respectivos comentarios
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comentarios');
    }
}
