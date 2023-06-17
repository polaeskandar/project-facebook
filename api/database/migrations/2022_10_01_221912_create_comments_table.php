<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('comments', function (Blueprint $table) {
      $table->id();
      $table->longText('body');
      $table->timestamps();
      $table->softDeletes();
      $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
      $table->foreignId('post_id')->constrained('posts')->cascadeOnDelete()->cascadeOnUpdate();
    });
  }

  public function down() {
    Schema::table('comments', function (Blueprint $table) {
      $table->dropForeign(['user_id']);
      $table->dropForeign(['post_id']);
      $table->dropIfExists();
    });
  }
};
