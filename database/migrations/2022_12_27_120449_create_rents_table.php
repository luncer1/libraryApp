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
        Schema::create('rents', function (Blueprint $table) {
            $table->id('id_rent');
            $table->dateTime('start_rent');
            $table->date('return_date');
            $table->boolean('overdue');
            $table->string('rent_state')->default('Oczekuje na odbiór');
            $table->foreignId('book_id')->references('id_book')->on('books');
            $table->foreignId('user_id')->nullable()->references('id_user')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rents');
    }
};
