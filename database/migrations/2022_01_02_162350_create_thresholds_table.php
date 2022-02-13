<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThresholdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thresholds', function (Blueprint $table) {
            $table->id();
            $table->string('year')->nullable();
            $table->string('cycle')->nullable();
            $table->string('amount')->nullable();
            $table->string('days')->nullable();
            $table->string('paid_by')->nullable();
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
        Schema::dropIfExists('thresholds');
    }
}
