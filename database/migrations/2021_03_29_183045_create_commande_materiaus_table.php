<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeMateriausTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('commande_materiaus', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('materiau_id');
            $table->unsignedBigInteger('commande_id');
            $table->double('quantite_materiau');
            $table->double('montant_materiau');
            $table->timestamps();
            
            $table->foreign('commande_id')
                ->references('id')
                ->on('commandes')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('materiau_id')
                ->references('id')
                ->on('materiaus')
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
        Schema::dropIfExists('commande_materiaus');
    }
}
