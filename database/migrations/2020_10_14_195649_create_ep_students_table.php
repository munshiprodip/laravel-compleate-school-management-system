<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ep_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('admission_no', 200)->nullable();
            $table->string('roll_no', 200)->nullable();
            $table->string('first_name', 200)->nullable();
            $table->string('last_name', 200)->nullable();
            $table->string('full_name', 200)->nullable();
            $table->string('date_of_birth', 200)->nullable();
            $table->string('mobile', 200)->nullable();
            $table->string('admission_date', 200)->nullable();
            $table->string('student_photo', 200)->nullable();
            $table->string('current_address', 200)->nullable();
            $table->string('permanent_address', 200)->nullable();
            $table->string('national_id', 200)->nullable();
            $table->string('bank_account_no', 200)->nullable();
            $table->string('bank_name', 200)->nullable();
            $table->string('previous_school_information', 500)->nullable();
            $table->string('additional_notes', 500)->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('bloodgroup_id')->nullable();
            $table->foreign('bloodgroup_id')->references('id')->on('ep_bloodgroups')->onDelete('cascade');

            $table->unsignedBigInteger('religion_id')->nullable();
            $table->foreign('religion_id')->references('id')->on('ep_religions')->onDelete('cascade');

            $table->unsignedBigInteger('student_category_id')->nullable();
            $table->foreign('student_category_id')->references('id')->on('ep_student_categorys')->onDelete('cascade');

            $table->unsignedBigInteger('class_id')->nullable();
            $table->foreign('class_id')->references('id')->on('ep_classes')->onDelete('cascade');

            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('ep_sections')->onDelete('cascade');

            $table->unsignedBigInteger('session_id')->nullable();
            $table->foreign('session_id')->references('id')->on('ep_sessions')->onDelete('cascade');

            $table->unsignedBigInteger('gender_id')->nullable();
            $table->foreign('gender_id')->references('id')->on('ep_genders')->onDelete('cascade');

            $table->unsignedBigInteger('parents_id')->nullable();
            $table->foreign('parents_id')->references('id')->on('ep_parents')->onDelete('cascade');

            $table->tinyInteger('active_status')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_students');
    }
}
