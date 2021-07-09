<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChantierPersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('chantier_personnels', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('chantier_id');
            $table->unsignedBigInteger('personnel_id');
            $table->date('date_affect');
            $table->date('date_fin_affect');
            $table->integer('effictif_reel');
            $table->double('montant_salaire');
            $table->double('salaire_reel');

            $table->timestamps();

            $table->foreign('personnel_id')
            ->references('id')
            ->on('personnels')
            ->onDelete('restrict')
            ->onUpdate('restrict');

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
        Schema::dropIfExists('chantier_personnels');
    }
}
