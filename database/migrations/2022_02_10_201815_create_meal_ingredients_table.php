<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meal_ingredients', function (Blueprint $table) {
            $table->bigInteger('meal_id')->unsigned()->index();
            $table->bigInteger('ingredient_id')->unsigned()->index();
            $table->foreign('meal_id')->references('id')->on('meals')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onUpdate('cascade')->onDelete('restrict');
            $table->primary(['meal_id', 'ingredient_id']);
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
        Schema::dropIfExists('meal_ingredients');
    }
}
