<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamerScoresConfigureTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create(
            'players', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->string('email', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'gamer_teams', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->string('icon', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'score_series', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'score_serie_point_types', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'competitions', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'competition_players', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pointables');
        Schema::dropIfExists('points');
    }

}
