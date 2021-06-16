<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("vehicule_id");

            $table->string('type_paiement');
            $table->unsignedInteger('nombre_places');
            $table->timestamp('du_date');
            $table->timestamp('au_date');
            $table->timestamps();

            $table->foreign("vehicule_id")
                ->references("id")
                ->on("vehicules")
                ->onDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contrats');
    }
}
