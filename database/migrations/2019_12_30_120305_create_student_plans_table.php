<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cost_id')->nullable();
            $table->unsignedInteger('num_subjects');
            $table->unsignedInteger('num_extra_subjects');
            $table->unsignedInteger('num_extra');
            $table->float("subject_fee_semester")->default(0);
            $table->float("additional_subject_fee_month")->default(0);
            $table->float("extra_curricular_subject_fee_month")->default(0);
            $table->float("reg_fee")->default(0);
            $table->float("re_reg_free")->default(0);
            $table->float(" cost_extra_materials")->default(0);
            $table->integer("start_month")->default(1);
            $table->integer("end_month")->default(1);
            $table->unsignedBigInteger("student_id");
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
        Schema::dropIfExists('student_plans');
    }
}
