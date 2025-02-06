<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('depenses', function (Blueprint $table) {
            $table->unsignedBigInteger('depense_id');
            $table->foreign('depense_id')->references('id')->on('typedepense')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('depenses', function (Blueprint $table) {
            // Supprime la contrainte de clé étrangère
            $table->dropForeign(['depense_id']);
            // Supprime la colonne depense_id
            $table->dropColumn('depense_id');
        });
    }
};
