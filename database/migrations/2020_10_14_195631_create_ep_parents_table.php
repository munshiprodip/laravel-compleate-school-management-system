<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ep_parents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fathers_name', 200)->nullable();
            $table->string('fathers_occupation', 200)->nullable();
            $table->string('fathers_mobile', 200)->nullable();
            $table->string('fathers_photo', 200)->nullable();

            $table->string('mothers_name', 200)->nullable();
            $table->string('mothers_occupation', 200)->nullable();
            $table->string('mothers_mobile', 200)->nullable();
            $table->string('mothers_photo', 200)->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('sms_parents');
    }
}
