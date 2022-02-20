<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('thumbnail')->nullable();
            $table->json('images')->nullable();
            $table->json('seo')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->integer('price');
            $table->integer('cost_price');
            $table->integer('discount')->nullable();
            $table->foreignId('brand_id')->nullable()->constrained();
            $table->boolean('status')->default(0);
            $table->boolean('featured')->default(0);
            $table->integer('quantity');
            $table->string('sku');
            $table->integer('weight');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
