<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::create('histories', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('sub_id')->constrained()->cascadeOnDelete();
      $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
      $table->string('operation');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('histories');
  }
};
