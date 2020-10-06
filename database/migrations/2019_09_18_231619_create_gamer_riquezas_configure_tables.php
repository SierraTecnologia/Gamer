<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamerRiquezasConfigureTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        /**
         * Undocumented function
         *
         * @return void
         */
        Schema::create(
            'coins', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->string('name', 255)->nullable();
                $table->string('text')->default('');
                $table->integer('position')->nullable();
                $table->integer('value')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
        
        Schema::create(
            'coinables', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id')->unsigned();
                $table->integer('coinable_id')->nullable();
                $table->string('coinable_type', 255)->nullable();
                $table->string('relation', 255)->nullable();

                $table->integer('coin_id')->nullable();
                // $table->foreign('coin_id')->references('id')->on('coins');
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
        Schema::dropIfExists('coinables');
        Schema::dropIfExists('coins');
    }

}
