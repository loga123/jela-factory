<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_tags', function (Blueprint $table) {
            $table->bigInteger('meal_id')->unsigned()->index();
            $table->bigInteger('tag_id')->unsigned()->index();
            $table->foreign('meal_id')->references('id')->on('meals')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('tag_id')->references('id')->on('tags')->onUpdate('cascade')->onDelete('restrict');
            $table->primary(['meal_id', 'tag_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_tags');
    }
}
