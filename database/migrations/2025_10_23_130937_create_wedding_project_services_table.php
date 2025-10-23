<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeddingProjectServicesTable extends Migration
{
    public function up(): void
    {
        Schema::create('wedding_project_services', function (Blueprint $table) {
            $table->id('wedding_project_services_id');
            $table->unsignedBigInteger('fk_service_id');
            $table->unsignedBigInteger('fk_wedding_project_id');
            $table->foreign('fk_service_id')->references('service_id')->on('services')->onDelete('cascade');
            $table->foreign('fk_wedding_project_id')->references('wedding_project_id')->on('wedding_project')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wedding_project_services');
    }
}
