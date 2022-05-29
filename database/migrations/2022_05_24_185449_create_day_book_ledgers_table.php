<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDayBookLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('day_book_ledgers', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->nullable();
            $table->integer('bank')->nullable();
            $table->string('mode',50)->nullable();
            $table->mediumText('receipt_no')->nullable();
            $table->mediumText('particular')->nullable();
            $table->dateTime('date');
            $table->double('credit',10,2);
            $table->double('debit',10,2);
            
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
        Schema::dropIfExists('day_book_ledgers');
    }
}
