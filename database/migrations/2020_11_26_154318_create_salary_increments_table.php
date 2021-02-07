<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryIncrementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_increments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date_of_increment')->nullable();
            $table->integer('basic_salary')->nullable();
            $table->integer('house_rent')->nullable();
            $table->integer('conveyance_allowance')->nullable();
            $table->integer('medical_allowance')->nullable();
            $table->integer('other_allowance')->nullable();
            $table->integer('total_increment')->nullable();

            $table->unsignedBigInteger('staff_id')->nullable();
            $table->foreign('staff_id')->references('id')->on('ep_staffs')->onDelete('cascade');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');


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
        Schema::dropIfExists('salary_increments');
    }
}
