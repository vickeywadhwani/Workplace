<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkplacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('workplaces', function (Blueprint $table) {
           $table->increments('id');
           $table->string('title');
           $table->decimal( 'price', 10, 2);
           $table->string('address')->nullable();
           $table->decimal('latitude', 10, 8)->nullable();
           $table->decimal('longitude', 11, 8)->nullable();
           $table->string('image')->nullable();
           $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('workplaces');
    }
}
