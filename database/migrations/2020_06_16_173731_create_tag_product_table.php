<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tag_id');
            $table->string('product_id');
            $table->timestamps();
            // $table->uuid('id')->primary();
            // $table->string('tag_id');
            // $table->string('product_id');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_product');
    }
}
