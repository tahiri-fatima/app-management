<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdreServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('ordreservices', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();  //correspond à la clé étrangère de la table
            $table->string('code_ordre_serv')->unique(); 
            $table->string('type_ordre_serv');
            $table->date('date_ordre_serv');
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
        Schema::dropIfExists('ordre_services');
    }
}
