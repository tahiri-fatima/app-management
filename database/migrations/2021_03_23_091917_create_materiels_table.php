<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materiels', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id(); //correspond à la clé étrangère de la table
            $table->string('code_materiel')->unique();
            $table->string('intitule_materiel');
            $table->boolean('type_interne_externe');
            $table->integer('taux_consommation');
            $table->integer('quantite');
         //   $table->double('valeur_achat');
        //    $table->string('caracteristique_thechnique');
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
        Schema::dropIfExists('materiels');
    }
}
