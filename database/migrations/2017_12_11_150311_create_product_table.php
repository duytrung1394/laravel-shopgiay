<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name",150);
            $table->string("slug_name",150)->nullable();
            $table->string("meta_name",150)->nullable();
            $table->string("image_product",250)->nullable();
            $table->text("description")->nullable();
            $table->text("detail")->nullable();
            $table->float("unit_price");
            $table->float("promotion_price")->default(0)->nullable();
            $table->integer("new")->default(0)->nullable();
            $table->integer("view_count")->nullable();
            $table->integer("cate_id");
            $table->integer("brand_id")->nullable();
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
        Schema::dropIfExists('product');
    }
}
