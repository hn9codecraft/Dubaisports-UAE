<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_groups', function (Blueprint $table) {
            $table->id();
            $table->text('title',200);
            $table->text('slug',200)->nullable();
            $table->text('icon')->nullable();
            $table->enum('status',['0','1'])->default('1');
            $table->enum('include_in_header',['0','1'])->default('0');
            $table->tinyInteger('sort')->nullable();
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
        Schema::dropIfExists('category_groups');
    }
}
