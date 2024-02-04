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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->text('description');
            $table->text('learning_titles')->nullable();
            $table->unsignedSmallInteger('total_time')->nullable();
            $table->unsignedTinyInteger('level');
            $table->unsignedInteger('price')->default(0);
            $table->unsignedTinyInteger('discount')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'package_user')->references('id')->on('users')->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->unsignedTinyInteger('group_id')->nullable();
            $table->foreign('group_id', 'package_group')->references('id')->on('groups')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
