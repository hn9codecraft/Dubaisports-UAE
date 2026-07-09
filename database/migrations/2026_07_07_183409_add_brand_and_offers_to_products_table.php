<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBrandAndOffersToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'combo_offer')) {
                $table->enum('combo_offer', ['0', '1'])->default('0')->after('popular_product');
            }
            if (!Schema::hasColumn('products', 'clearance_sale')) {
                $table->enum('clearance_sale', ['0', '1'])->default('0')->after('combo_offer');
            }
            if (!Schema::hasColumn('products', 'brand_id')) {
                $table->integer('brand_id')->unsigned()->nullable()->after('category_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'combo_offer')) {
                $table->dropColumn('combo_offer');
            }
            if (Schema::hasColumn('products', 'clearance_sale')) {
                $table->dropColumn('clearance_sale');
            }
            if (Schema::hasColumn('products', 'brand_id')) {
                $table->dropColumn('brand_id');
            }
        });
    }
}
