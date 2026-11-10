<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::create('tickets', function(Blueprint $table) {
   $table->id(); $table->string('subject'); $table->string('customer_email');
   $table->text('description'); $table->string('priority');
   $table->string('status'); $table->timestamps();
  });
 }
 public function down(): void { Schema::dropIfExists('tickets'); }
};
