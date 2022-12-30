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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user')->unsigned();
            $table->string('login')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->date('birth_date');
            $table->integer('books_rented')->default(0);
            $table->timestamps();
            $table->foreignId('created_by')->nullable()->references('id_user')->on('users')->onDelete('set null');
            $table->foreignId('modified_by')->nullable()->references('id_user')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
