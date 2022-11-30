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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->string('author');
            $table->string('publisher');
            $table->string('cover'); 
            $table->float('price');
            $table->integer('views'); 
            $table->integer('stock'); 
            $table->enum('PUBLISH I DRAFT',['submit', 'proses', 'finish', 'cancel']); 
            $table->integer('created_by');
            $table->integer('deleted_by'); 
            $table->integer('updated_by'); 
            $table->integer('deleted_at');
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
        Schema::dropIfExists('books');
    }
};
