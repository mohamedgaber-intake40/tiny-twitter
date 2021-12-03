<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    protected static $stringMaxLength = 100;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //todo add columns length
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',self::$stringMaxLength);
            $table->string('email',self::$stringMaxLength)->unique();
            $table->string('password',self::$stringMaxLength);
            $table->string('image');
            $table->date('date_of_birth');
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
