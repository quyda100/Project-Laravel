<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productoptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("product_id")->unsigned()->index();;
            $table->integer("options_id")->unsigned()->index();;
            $table->integer("optiongroup_id");
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('options_id')->references('id')->on('options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productoptions');
    }
}
