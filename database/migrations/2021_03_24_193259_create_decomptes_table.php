<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecomptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('decomptes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();  //correspond à la clé étrangère de la table
            $table->integer('num_decompte')->unique(); 
            $table->date('date_decompte');
            $table->double('montant_decompte');
            $table->boolean('accorde');
            $table->double('retunue_garantie');
            $table->double('revision_prix')->nullable();
            $table->unsignedBigInteger('chantier_id');
            $table->timestamps();
            
            $table->foreign('chantier_id')
                ->references('id')
                ->on('chantiers')
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
        Schema::dropIfExists('decomptes');
    }
}
