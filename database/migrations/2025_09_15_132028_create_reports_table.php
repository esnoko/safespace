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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number', 12)->unique();
            $table->enum('category', [
                'bullying', 
                'substance_abuse', 
                'sexual_harassment', 
                'weapons', 
                'teenage_pregnancy', 
                'violence',
                'harassment',
                'other'
            ]);
            $table->text('description');
            $table->string('location')->nullable();
            $table->date('incident_date')->nullable();
            $table->time('incident_time')->nullable();
            $table->json('evidence_files')->nullable(); // Store file paths as JSON
            $table->enum('status', ['pending', 'reviewing', 'investigated', 'resolved'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
            
            $table->index('reference_number');
            $table->index('category');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};