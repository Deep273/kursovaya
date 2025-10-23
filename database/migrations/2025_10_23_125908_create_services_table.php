<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id('service_id');
            $table->string('name', 100);
            $table->enum('category', [
                'Кейтеринг',
                'Церемонии',
                'Стилисты и Визажисты',
                'Организация',
                'Фотограф и фотозоны'
            ]);
            $table->decimal('price', 5, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
}
