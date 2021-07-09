<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFraisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frais', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();  //correspond à la clé étrangère de la table
            $table->string('code_frais')->unique(); 
            $table->date('date_frais');
            $table->double('montant_frais');
            $table->string('cible_frais'); 
            $table->unsignedBigInteger('chantier_id');
            $table->unsignedBigInteger('nature_frais_id');
            $table->timestamps();
            
            $table->foreign('chantier_id')
                ->references('id')
                ->on('chantiers')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            
            $table->foreign('nature_frais_id')
            ->references('id')
            ->on('nature_frais')
            ->onDelete('restrict')
            ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frais');
    }
}
