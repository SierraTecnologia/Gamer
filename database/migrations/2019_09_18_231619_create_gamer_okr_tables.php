<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamerOkrTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create(
            'missions', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('code')->unique();
                $table->primary('code');
                $table->string('name', 255)->nullable();
                $table->string('text')->default('');
                $table->integer('position')->nullable();
                $table->integer('value')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'missionables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('missionable_id')->nullable();
                $table->string('missionable_type', 255)->nullable();
                $table->string('relation', 255)->nullable();

                $table->string('mission_code')->nullable();
                // $table->foreign('mission_code')->references('code')->on('missions');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'objectives', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('code')->unique();
                $table->primary('code');
                $table->string('name', 255)->nullable();
                $table->string('text')->default('');
                $table->integer('position')->nullable();
                $table->integer('value')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'objectiveables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('objectiveable_id')->nullable();
                $table->string('objectiveable_type', 255)->nullable();
                $table->string('relation', 255)->nullable();

                $table->string('objective_code')->nullable();
                // $table->foreign('objective_code')->references('code')->on('objectives');
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'metas', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->string('code')->unique();
                $table->primary('code');
                $table->string('name', 255)->nullable();
                $table->string('text')->default('');
                $table->integer('position')->nullable();
                $table->integer('value')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'metables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('metable_id')->nullable();
                $table->string('metable_type', 255)->nullable();
                $table->string('relation', 255)->nullable();

                $table->string('meta_code')->nullable();
                // $table->foreign('meta_code')->references('code')->on('metas');
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
        Schema::dropIfExists('metables');
        Schema::dropIfExists('metas');

        Schema::dropIfExists('objectiveables');
        Schema::dropIfExists('objectives');

        Schema::dropIfExists('missionables');
        Schema::dropIfExists('missions');
    }

}
