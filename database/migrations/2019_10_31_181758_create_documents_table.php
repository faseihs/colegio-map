<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('birth_certificate')->nullable();
            $table->longText('curp')->nullable();
            $table->longText('high_school_certificate')->nullable();
            $table->longText('home_address')->nullable();
            $table->longText('photos')->nullable();
            $table->longText('official_id')->nullable();
            $table->longText('insurance')->nullable();
            $table->longText('aes')->nullable();
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
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
        Schema::dropIfExists('documents');
    }
}
