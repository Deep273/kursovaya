<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeddingProjectTable extends Migration
{
    public function up(): void
    {
        Schema::create('wedding_project', function (Blueprint $table) {
            $table->id('wedding_project_id');
            $table->timestamp('date')->unique();
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('fk_user_id');
            $table->foreign('fk_user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wedding_project');
    }
}
