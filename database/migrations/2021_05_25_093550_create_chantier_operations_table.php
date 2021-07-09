<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChantierOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('chantier_operations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('chantier_id');
            $table->unsignedBigInteger('operation_id');
            $table->integer('quantite_operation');
            $table->double('prix_unitaire_revient');
            $table->double('prix_unitaire_vente');
            $table->date('date_deb_operation');
            $table->date('date_fin_operation');
            $table->integer('taux_ajustement');
            $table->double('montant_estimee');

            $table->timestamps();
            
            $table->foreign('operation_id')
                ->references('id')
                ->on('operations')
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
        Schema::dropIfExists('chantier_operations');
    }
}
