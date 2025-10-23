<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritePhotosTable extends Migration
{
    public function up(): void
    {
        Schema::create('favorite_photos', function (Blueprint $table) {
            $table->id('favorite_photo_id');
            $table->text('link')->unique();
            $table->unsignedBigInteger('fk_user_id');
            $table->foreign('fk_user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorite_photos');
    }
}
