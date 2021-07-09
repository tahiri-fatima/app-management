<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChantiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('chantiers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('code_chantier')->unique(); 
            $table->string('intitule_chantier');
            $table->string('localisation');
            $table->date('date_debut_chantier');
            $table->date('date_fin_chantier')->nullable();
            $table->string('numero_marche')->nullable();
            $table->bigInteger('montant_marche');
            $table->integer('r_garantie');
            
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
        Schema::dropIfExists('chantiers');
    }
}
