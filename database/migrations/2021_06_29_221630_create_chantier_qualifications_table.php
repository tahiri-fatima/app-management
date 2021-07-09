<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChantierQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('chantier_qualifications', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('chantier_id');
            $table->unsignedBigInteger('qualification_id');
            $table->integer('effictif_estimee');
            $table->integer('duree_estimee');
            $table->double('salaire_estimee');

            $table->timestamps();

            $table->foreign('qualification_id')
            ->references('id')
            ->on('qualifications')
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
        Schema::dropIfExists('chantier_qualifications');
    }
}
