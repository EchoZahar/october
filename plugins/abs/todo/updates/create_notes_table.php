<?php namespace Abs\ToDo\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateNotesTable Migration
 */
class CreateNotesTable extends Migration
{
    public function up()
    {
        Schema::create('abs_todo_notes', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('description');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('abs_todo_notes');
    }
}
