<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMacrocategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('macrocategories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome_it')->nullable();
            $table->string('nome_en')->nullable();
            $table->string('nome_de')->nullable();
            $table->string('nome_fr')->nullable();
            $table->string('nome_es')->nullable();
            $table->string('nome_ru')->nullable();
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
        Schema::dropIfExists('macrocategories');
    }
}
