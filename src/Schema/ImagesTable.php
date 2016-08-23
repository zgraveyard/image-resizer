<?php namespace Resizer\Schema;

use Illuminate\Database\Capsule\Manager as Capsule;

class ImagesTable
{

    public function create()
    {
        return Capsule::schema('default')->create('images',function($table){
            $table->increments('id');
            $table->text('original');
            $table->json('images')->nullable();
            $table->boolean('processed')->default(0);
            $table->timestamps();
        });
    }
    public function drop()
    {
        return Capsule::schema('default')->dropIfExists('images');
    }
}