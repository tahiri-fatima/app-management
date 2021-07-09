<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChantierNatureFraisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('chantier_nature_frais', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('chantier_id');
            $table->unsignedBigInteger('nature_frais_id');
            $table->double('montant_estimee');

            $table->timestamps();

            $table->foreign('nature_frais_id')
            ->references('id')
            ->on('nature_frais')
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
        Schema::dropIfExists('chantier_nature_frais');
    }
}
