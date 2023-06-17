<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('image');
    });

    Schema::create('profile_images', function (Blueprint $table) {
      $table->id();
      $table->text('image');
      $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  public function down() {
    Schema::table('profile_images', function (Blueprint $table) {
      $table->dropForeign(['user_id']);
      $table->dropIfExists();
    });
  }
};
