<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('answer_choices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')->references('id')->on('form_questions');
            $table->unsignedBigInteger('submission_id');
            $table->foreign('submission_id')->references('id')->on('submissions');
            $table->unsignedBigInteger('multiple_choice_id');
            $table->foreign('multiple_choice_id')->references('id')->on('multiple_choices');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_choices');
    }
};
