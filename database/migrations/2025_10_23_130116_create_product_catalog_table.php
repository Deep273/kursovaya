<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCatalogTable extends Migration
{
    public function up(): void
    {
        Schema::create('product_catalog', function (Blueprint $table) {
            $table->id('product_catalog_id');
            $table->string('name', 50);
            $table->text('description');
            $table->enum('category', [
                'Мужская одежда',
                'Свадебные платья',
                'Аксессуары',
                'Украшения и декор',
                'Свадебные кольца'
            ]);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_catalog');
    }
}
