<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('first_name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('boss_code')->nullable();
            $table->string('My_boss_code')->nullable();
            $table->integer('age');
            $table->string('role')->default('guest');
            $table->string('profession');
            $table->string('birth_city');
            $table->string('city');
            $table->string('telephone')->unique();
            $table->integer('amount');
            $table->integer('current_amount');
            $table->string('paiement');
            $table->string('sex');
            $table->integer('confirm_transaction')->default('0');
            $table->integer('confirm_account')->default('0');
            $table->integer('preboss')->default('0');
            $table->integer('injector_boss')->default('0');
            $table->integer('advanced_boss')->default('0');
            $table->integer('privilege')->default('0');
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
}
