<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('personnels', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id(); //correspond à la clé étrangère de la table
            $table->string('code_personne')->unique(); 
            $table->string('nom_personne');
            $table->string('prenom_personne');
            $table->string('fonction');
            $table->string('num_cnss');
            $table->double('montant_cnss');
            $table->date('date_embauche');
            $table->string('tele');
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('qualification_id');
            $table->timestamps();
            
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('qualification_id')
                ->references('id')
                ->on('qualifications')
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
        Schema::dropIfExists('personnels');
    }
}
