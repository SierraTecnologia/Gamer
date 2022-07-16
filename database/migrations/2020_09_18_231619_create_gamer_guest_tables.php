<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGamerGuestTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'guests', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'questions', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('event', 255)->nullable();
                $table->integer('user_id')->nullable();
                $table->integer('position')->nullable();
                $table->integer('value')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        Schema::create(
            'question_responses', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->integer('position')->nullable();
                $table->integer('value')->nullable();

                $table->integer('user_id')->nullable();
                $table->integer('question_id')->nullable();
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
        Schema::dropIfExists('guests');
    }
}
