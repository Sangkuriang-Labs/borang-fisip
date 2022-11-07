<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::create('contents', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignUuid('sub_id')->constrained()->cascadeOnDelete();
      $table->string('description');
      $table->text('content');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('contents');
  }
};
