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
        Schema::table('follows', function (Blueprint $table) {
            $table->renameColumn('following', 'following_id');
            $table->renameColumn('followed', 'follower_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('follows', function (Blueprint $table) {
            $table->renameColumn('following_id', 'following');
            $table->renameColumn('follower_id', 'followed');
        });
    }
};
