<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('posts', function (Blueprint $table) {
      $table->id();
      $table->longText('body');
      $table->timestamps();
      $table->softDeletes();
      $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
    });
  }

  public function down() {
    Schema::table('posts', function (Blueprint $table) {
      $table->dropForeign(['user_id']);
      $table->dropIfExists();
    });
  }
};
