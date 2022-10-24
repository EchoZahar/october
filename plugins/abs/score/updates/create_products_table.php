<?php namespace Abs\Score\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateProductsTable Migration
 */
class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('abs_score_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('abs_score_products');
    }
}
