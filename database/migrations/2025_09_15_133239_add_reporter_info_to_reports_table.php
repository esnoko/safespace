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
            $table->boolean('is_anonymous')->default(true)->after('reference_number');
            $table->string('reporter_name')->nullable()->after('is_anonymous');
            $table->string('reporter_email')->nullable()->after('reporter_name');
            $table->string('reporter_phone')->nullable()->after('reporter_email');
            $table->string('reporter_grade')->nullable()->after('reporter_phone');
            $table->string('reporter_student_id')->nullable()->after('reporter_grade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn([
                'is_anonymous',
                'reporter_name',
                'reporter_email',
                'reporter_phone',
                'reporter_grade',
                'reporter_student_id'
            ]);
        });
    }
};