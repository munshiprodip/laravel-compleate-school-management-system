<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_process', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('salary_year')->nullable();
            $table->string('salary_month')->nullable();

            $table->unsignedBigInteger('staff_id')->nullable();
            $table->foreign('staff_id')->references('id')->on('ep_staffs')->onDelete('cascade');

            $table->integer('basic_salary')->nullable();
            $table->integer('house_rent')->nullable();
            $table->integer('conveyance_allowance')->nullable();
            $table->integer('medical_allowance')->nullable();
            $table->integer('other_allowance')->nullable();
            $table->integer('gross_salary')->nullable();

            $table->integer('d_pf')->nullable();
            $table->integer('d_insurance')->nullable();
            $table->integer('d_loan')->nullable();
            $table->integer('d_house_rent')->nullable();
            $table->integer('d_utility')->nullable();
            $table->integer('d_others')->nullable();
            $table->integer('d_total_deduction')->nullable();

            $table->integer('net_salary')->nullable();

            $table->string('status')->default('Unpaid');


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
        Schema::dropIfExists('salary_process');
    }
}
