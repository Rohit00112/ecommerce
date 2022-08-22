<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->text('summary')->nullable();
            $table->text('description')->nullable();
            $table->text('features')->nullable();
            $table->string('feature_image')->nullable();
            $table->string('price')->nullable();
            $table->string('discount')->nullable();
            $table->unsignedBigInteger('extrafields_id')->nullable();
            $table->string('status')->nullable();
            $table->boolean('is_featured')->nullable();
            $table->enum('type',['new','popular'])->nullable();
            $table->integer('stock')->nullable();
            $table->unsignedBigInteger('uploader_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('extrafields_id')->references('id')->on('extrafields')->onDelete('cascade');
            $table->foreign('uploader_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
};
