<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccumulatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accumulates', function (Blueprint $table) {
            $table->id();
            $table->string('payroll_no');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('accumalative_payrol_value');
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
        Schema::dropIfExists('accumulates');
    }
}
