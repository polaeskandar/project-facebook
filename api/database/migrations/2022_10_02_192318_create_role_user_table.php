<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('role_user', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
      $table->foreignId('role_id')->constrained('roles')->cascadeOnUpdate()->cascadeOnDelete();
    });
  }

  public function down() {
    Schema::table('role_user', function (Blueprint $table) {
      $table->dropForeign(['user_id']);
      $table->dropForeign(['role_id']);
      $table->dropIfExists();
    });
  }
};
