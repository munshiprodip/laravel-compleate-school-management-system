<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ep_staffs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('staff_id', 100)->nullable();
            $table->string('first_name', 200)->nullable();
            $table->string('last_name', 200)->nullable();
            $table->string('full_name', 200)->nullable();
            $table->string('fathers_name', 100)->nullable();
            $table->string('mothers_name', 100)->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('date_of_joining')->nullable();
            $table->string('nid')->nullable();
            $table->string('email', 50)->nullable();
            $table->string('mobile', 50)->nullable();
            $table->string('emergency_mobile', 50)->nullable();
            $table->string('marital_status', 30)->nullable();
            $table->string('staff_photo')->nullable();
            $table->string('current_address', 500)->nullable();
            $table->string('permanent_address', 500)->nullable();
            $table->string('qualification', 200)->nullable();
            $table->string('experience', 200)->nullable();
            $table->string('contract_type', 200)->nullable();
            $table->string('casual_leave', 15)->nullable();
            $table->string('medical_leave', 15)->nullable();
            $table->string('metarnity_leave', 15)->nullable();
            $table->string('bank_account_name', 50)->nullable();
            $table->string('bank_account_no', 50)->nullable();
            $table->string('bank_name', 20)->nullable();
            $table->string('bank_branch', 30)->nullable();
            $table->string('facebook_url', 100)->nullable();
            $table->string('twiteer_url', 100)->nullable();
            $table->string('linkedin_url', 100)->nullable();
            $table->string('instagram_url', 100)->nullable();
            $table->string('joining_letter', 500)->nullable();
            $table->string('resume', 500)->nullable();
            $table->string('other_document', 500)->nullable();
            $table->string('notes', 500)->nullable();
            $table->string('driving_license', 255)->nullable();
            $table->string('driving_license_ex_date', 200)->nullable();

            $table->integer('basic_salary')->nullable();
            $table->integer('house_rent')->nullable();
            $table->integer('conveyance_allowance')->nullable();
            $table->integer('medical_allowance')->nullable();
            $table->integer('other_allowance')->nullable();
            $table->integer('gross_salary')->nullable();
            $table->timestamps();


            $table->unsignedBigInteger('designation_id')->nullable()->default(1);
            $table->foreign('designation_id')->references('id')->on('ep_designations')->onDelete('cascade');

            $table->unsignedBigInteger('department_id')->nullable()->default(1);
            $table->foreign('department_id')->references('id')->on('ep_departments')->onDelete('cascade');

            $table->unsignedBigInteger('gender_id')->nullable()->default(1);
            $table->foreign('gender_id')->references('id')->on('ep_genders')->onDelete('cascade');
            $table->unsignedBigInteger('bloodgroup_id')->nullable();
            $table->foreign('bloodgroup_id')->references('id')->on('ep_bloodgroups')->onDelete('cascade');

            $table->unsignedBigInteger('religion_id')->nullable();
            $table->foreign('religion_id')->references('id')->on('ep_religions')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->tinyInteger('active_status')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ep_staffs');
    }
}
