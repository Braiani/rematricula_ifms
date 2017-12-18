<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('id');
            $table->string('name');
            $table->integer('siape');
            $table->string('password');
            $table->integer('perfil');
            $table->rememberToken();
            $table->timestamps();
            
            $table->primary(array('siape'));
        });
//        Schema::table('users', function (Blueprint $table) {
//            $table->integer('id', true, true)->change();
//        });
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
