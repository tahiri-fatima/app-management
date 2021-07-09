<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('commandes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id(); //correspond à la clé étrangère de la table
            $table->string('code_commande')->unique();
            $table->date('date_commande');  
            $table->double('total_commande')->nullable();                    
            $table->unsignedBigInteger('chantier_id');
            $table->unsignedBigInteger('fournisseur_id');
            $table->timestamps();
            
            
            $table->foreign('fournisseur_id')
                ->references('id')
                ->on('fournisseurs')
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
        Schema::dropIfExists('commandes');
    }
}
