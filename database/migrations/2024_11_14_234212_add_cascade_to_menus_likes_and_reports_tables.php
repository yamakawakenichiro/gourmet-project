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
        // menusテーブルの外部キーにcascadeを追加
        //dropForeign(['user_id'])は、Laravelのマイグレーションで外部キー制約を削除する.
        //外部キー制約を更新するために一旦削除し、その後再度追加するなどの場面で使用されます。
        //foreignId('user_id')は、カラムの定義と外部キー制約の設定を一行で簡潔に行うための方法です。
        //foreign('user_id')は、既に存在するカラムに対して外部キー制約を追加する場合に使用されます。
        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        // likesテーブルの外部キーにcascadeを追加 
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['menu_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });
        // reportsテーブルの外部キーにcascadeを追加 
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['menu_id']);
            $table->dropForeign(['category_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // menusテーブルの外部キーを元に戻す 
        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users');
        });
        // likesテーブルの外部キーを元に戻す 
        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['menu_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('menu_id')->references('id')->on('menus');
        });
        // reportsテーブルの外部キーを元に戻す 
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['menu_id']);
            $table->dropForeign(['category_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }
};
