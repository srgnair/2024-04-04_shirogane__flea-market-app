<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // 外部キー制約を削除
            $table->dropForeign(['reviewee_id']);

            // 新しい外部キー制約を追加
            $table->foreign('reviewee_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            // 新しい外部キー制約を削除
            $table->dropForeign(['reviewee_id']);

            // 元の外部キー制約を追加
            $table->foreign('reviewee_id')->references('id')->on('items')->onDelete('cascade');
        });
    }
};
