<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            //basic info
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('residence_address')->nullable();
            $table->string('photo')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('hire_date')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('regular_hours')->nullable();
            $table->string('hourly_rate')->nullable();
            $table->string('ot_rate')->nullable();
            $table->string('department')->nullable();
            $table->string('statutory_deductions')->nullable();
            $table->string('attn_inc_rate')->nullable();
//contact
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_number')->nullable();
//education and experience
            $table->string('education')->nullable();
            $table->string('experience')->nullable();
//bank info
            $table->string('id_type')->nullable();
            $table->string('id_number')->nullable();
            $table->string('bank')->nullable();
            $table->string('account_number')->nullable();
            $table->string('branch')->nullable();
            $table->string('bank_photo')->nullable();
            $table->string('trn')->nullable();
            $table->string('nis')->nullable();
            $table->string('user_role');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
