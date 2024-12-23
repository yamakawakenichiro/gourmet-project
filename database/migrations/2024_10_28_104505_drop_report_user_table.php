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
        Schema::dropIfExists('report_user');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('report_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('report_id')->constrained();
            $table->timestamp('created_at')->useCurrent();
        });
    }
};
