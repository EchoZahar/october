<?php

namespace Abs\Score\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateCategoriesTable Migration
 */
class CreateCategoryProductTable extends Migration
{
    public function up()
    {
        Schema::create('abs_score_category_product', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->primary(['category_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('abs_score_category_product');
    }
}
