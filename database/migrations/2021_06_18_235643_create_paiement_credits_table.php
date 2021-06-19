<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiement_credits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("credit_id");
            $table->unsignedInteger("montant");
            $table->string('type_paiement');
            $table->timestamps();

            $table->foreign("credit_id")
                ->references("id")
                ->on("credits")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiement_credits');
    }
}
