<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChantierMaterielsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('chantier_materiels', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('chantier_id');
            $table->unsignedBigInteger('materiel_id');
            $table->date('d_debut_service');
            $table->date('d_fin_service');
            $table->double('prix_unit');
            $table->integer('t_ajustement');
            $table->double('mont_net');
            $table->timestamps();
            
            $table->foreign('materiel_id')
                ->references('id')
                ->on('materiels')
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
        Schema::dropIfExists('chantier_materiels');
    }
}
