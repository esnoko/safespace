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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('code', 10)->unique()->index();
            $table->string('province', 50)->index();
            $table->string('district', 100)->nullable();
            $table->string('type', 20)->default('Secondary'); // Primary, Secondary, Combined
            $table->string('status', 20)->default('active'); // active, inactive
            $table->string('admin_password')->nullable(); // For school admin access
            $table->text('address')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};