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
        // Add column if missing
        if (!Schema::hasColumn('reports', 'school_code')) {
            Schema::table('reports', function (Blueprint $table) {
                $table->string('school_code', 10)->nullable()->after('reference_number');
                $table->index('school_code');
                $table->foreign('school_code')->references('code')->on('schools')->cascadeOnUpdate()->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('reports', 'school_code')) {
            Schema::table('reports', function (Blueprint $table) {
                try {
                    $table->dropForeign(['school_code']);
                } catch (\Throwable $e) {
                    // ignore
                }
                try {
                    $table->dropIndex(['school_code']);
                } catch (\Throwable $e) {
                    // ignore
                }
                $table->dropColumn('school_code');
            });
        }
    }
}; 