<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Assure-toi que cette ligne est présente


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('depenses', 'typedepense_id')) {
            // Supprimer la contrainte de clé étrangère
            Schema::table('depenses', function (Blueprint $table) {
                $table->dropForeign(['depense_id']); // Supprimer la clé étrangère
            });

            // Ajouter la colonne typedepense_id
            Schema::table('depenses', function (Blueprint $table) {
                $table->unsignedBigInteger('typedepense_id')->nullable();
            });

            // Copier les données de depense_id vers typedepense_id
            DB::statement('UPDATE depenses SET typedepense_id = depense_id');

            // Supprimer la colonne depense_id après la mise à jour
            Schema::table('depenses', function (Blueprint $table) {
                $table->dropColumn('depense_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {



        // Recréer la colonne depense_id
        if (!Schema::hasColumn('depenses', 'depense_id')) {
            // Recréer la colonne depense_id
            Schema::table('depenses', function (Blueprint $table) {
                $table->unsignedBigInteger('depense_id')->nullable();
            });

            // Copier les données de typedepense_id vers depense_id
            DB::statement('UPDATE depenses SET depense_id = typedepense_id');

            // Supprimer la colonne typedepense_id
            Schema::table('depenses', function (Blueprint $table) {
                $table->dropColumn('typedepense_id');
            });
        }
    }
};
