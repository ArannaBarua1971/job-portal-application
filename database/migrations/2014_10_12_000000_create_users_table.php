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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('status')->default(true);
            $table->integer('phone')->nullable();
            $table->LongText('company_name')->nullable();
            $table->LongText('facebook')->nullable();
            $table->LongText('twitter')->nullable();
            $table->LongText('linkedin')->nullable();
            $table->LongText('youtube')->nullable();
            $table->LongText('whatsapp')->nullable();
            $table->longText('working_exp')->nullable();
            $table->longText('skills')->nullable();
            $table->string('portfolio')->nullable();
            $table->longText('education')->nullable();
            $table->longText('certificates')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
