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
            $table->unsignedInteger('category_id');
            $table->text('details')->nullable();
            $table->text('description')->nullable();
            $table->text('description_2')->nullable();
            $table->string('main_image');
            $table->text('other_images')->nullable();
            $table->double('price', [10,2])->default(0);
            $table->double('discounted_price', [10,2])->default(0);
            $table->tinyInteger('discount_percentage')->default(0);
            $table->enum('status',['0','1'])->default('1');
            $table->enum('best_seller',['0','1'])->default('0');
            $table->enum('popular_product',['0','1'])->default('0');
            $table->tinyInteger('sort')->nullable();
            $table->string('image_prefix_folder')->nullable();
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
