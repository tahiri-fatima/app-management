<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('factures', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id(); //correspond à la clé étrangère de la table
            $table->string('code_facture')->unique();
            $table->date('date_facture');
            $table->double('montant_facture');
            $table->boolean('reglee');
            $table->string('montant_en_lettre');
            $table->double('cumul_acompte')->default('0.0');
            $table->unsignedBigInteger('commande_id');
            $table->timestamps();
            
            $table->foreign('commande_id')
                ->references('id')
                ->on('commandes')
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
        Schema::dropIfExists('factures');
    }
}
