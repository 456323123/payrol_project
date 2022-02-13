<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProceedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proceeds', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('nis');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('total_pay');
            $table->string('edtax');
            $table->string('income')->nullable();
            $table->string('nht');
            $table->string('status');

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
        Schema::dropIfExists('proceeds');
    }
}
