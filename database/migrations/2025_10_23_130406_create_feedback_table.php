<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id('feedback_id');
            $table->text('text');
            $table->timestamp('date');
            $table->integer('estimation')->unsigned()->check('estimation >= 0 AND estimation <= 5');
            $table->unsignedBigInteger('fk_user_id');
            $table->unsignedBigInteger('fk_wedding_project_id');
            $table->foreign('fk_user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('fk_wedding_project_id')->references('wedding_project_id')->on('wedding_project')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
}
