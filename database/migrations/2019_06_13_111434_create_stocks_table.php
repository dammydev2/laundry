<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('cus_id');
            $table->string('tag');
            $table->string('category');
            $table->string('qty');
            $table->string('exp');
            $table->string('fold');
            $table->string('price');
            $table->string('info')->nullable();
            $table->string('addamount')->nullable();
            $table->string('collect_date')->nullable();
            $table->string('discount')->nullable();
            $table->string('balance')->nullable();
            $table->string('deposit')->nullable();
            $table->string('balance_paid')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('stocks');
    }
}
