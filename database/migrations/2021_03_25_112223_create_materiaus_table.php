<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriausTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('materiaus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id(); //correspond à la clé étrangère de la table
            $table->string('code_materiau')->unique();
            $table->string('intitule_materiau'); 
            $table->double('prix_unit_materiau'); 
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
        Schema::dropIfExists('materiaus');
    }
}
