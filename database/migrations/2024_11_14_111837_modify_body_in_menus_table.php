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
        Schema::table('menus', function (Blueprint $table) {
            // まずカラムを削除する
            $table->dropColumn('body');
        });

        Schema::table('menus', function (Blueprint $table) {
            // `count`カラムの後に`body`カラムを追加する
            $table->text('body')->nullable()->after('count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            // カラムを削除し、新たに元の状態に戻す
            $table->dropColumn('body');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->text('body', 200)->nullable(false)->after('count'); // `count`の後に追加
        });
    }
};
