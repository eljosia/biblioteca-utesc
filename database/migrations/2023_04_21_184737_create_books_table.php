<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('folio',35)->nullable();
            $table->string('isbn',40)->nullable();
            $table->string('title',255);
            $table->string('autor', 155)->nullable();
            $table->string('description',5000)->nullable();
            $table->string('editorial',45)->nullable();
            $table->unsignedBigInteger('area')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('edition', 50)->nullable();
            $table->string('country', 45)->nullable();
            $table->date('date_of_pub')->nullable();
            $table->integer('pages')->nullable();
            $table->string('shelf', 10)->nullable();
            $table->boolean('status')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->default(1);
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('classification_id')->nullable();
            $table->date('date_of_acq');

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('area')->references('id')->on('careers');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
