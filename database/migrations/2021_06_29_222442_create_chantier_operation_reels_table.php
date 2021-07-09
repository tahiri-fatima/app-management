<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChantierOperationReelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('chantier_operation_reels', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('chantier_id');
            $table->unsignedBigInteger('operation_id');
            $table->integer('quantite_realisee');
            $table->date('date_execution');
            $table->double('montant_execution_revient');
            $table->double('montant_execution_vente');
            $table->double('montant_encaisse')->default(0);

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
        Schema::dropIfExists('chantier_operation_reels');
    }
}
