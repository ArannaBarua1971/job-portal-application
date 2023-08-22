<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('job_title');
            $table->string('slug')->unique();
            $table->string('position_title');
            $table->longText('job_description');
            $table->integer('job_salary_min')->nullable();
            $table->integer('job_salary_max')->nullable();
            $table->string('job_location');
            $table->string('job_type');
            $table->longText('required_skills');
            $table->longText('education')->nullable();
            $table->integer('seats')->nullable();
            $table->integer('work_exp')->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('job_posts');
    }
};
