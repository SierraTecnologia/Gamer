<?php
/**
 * Todo Fazer aqui, Metas e Recompensas
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamerRecompensasConfigureTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        // Schema::create(
        //     'points', function (Blueprint $table) {
        //         $table->engine = 'InnoDB';
        //         $table->increments('id')->unsigned();
        //         $table->string('name', 255)->nullable();
        //         $table->string('text')->default('');
        //         $table->integer('position')->nullable();
        //         $table->integer('value')->nullable();
        //         $table->timestamps();
        //         $table->softDeletes();
        //     }
        // );
        
        // Schema::create(
        //     'pointables', function (Blueprint $table) {
        //         $table->engine = 'InnoDB';
        //         $table->increments('id')->unsigned();
        //         $table->string('pointable_id')->nullable();
        //         $table->string('pointable_type', 255)->nullable();
        //         $table->string('relation', 255)->nullable();

        //         $table->integer('point_id')->nullable();
        //         // $table->foreign('point_id')->references('id')->on('points');
        //         $table->timestamps();
        //         $table->softDeletes();
        //     }
        // );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('pointables');
        // Schema::dropIfExists('points');
    }

}
