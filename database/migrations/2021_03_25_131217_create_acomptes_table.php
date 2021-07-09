<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcomptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('acomptes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id(); //correspond à la clé étrangère de la table
            $table->string('code_acompte')->unique();
            $table->date('date_acompte');
            $table->double('montant_acompte');
            $table->string('type_reglement');
            $table->unsignedBigInteger('facture_id');
            $table->timestamps();
            
            $table->foreign('facture_id')
                ->references('id')
                ->on('factures')
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
        Schema::dropIfExists('acomptes');
    }
}
