<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            // Check if column doesn't exist before adding
            if (!Schema::hasColumn('reports', 'involved_parties')) {
                $table->text('involved_parties')->nullable()->after('incident_time');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            if (Schema::hasColumn('reports', 'involved_parties')) {
                $table->dropColumn('involved_parties');
            }
        });
    }
};
