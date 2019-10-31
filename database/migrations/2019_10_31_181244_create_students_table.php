<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('name')->nullable();
            $table->string('group')->nullable();
            $table->date('dob')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->string('program')->nullable();
            $table->string('classroom_number')->nullable();
            $table->string('semester')->nullable();
            $table->date('date_of_admission')->nullable();
            $table->primary('id');
            $table->softDeletes();
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
        Schema::dropIfExists('students');
    }
}
