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
        Schema::create('roles', function(Blueprint $table){
            $table->increments('id');
            $table->string('rol')->comment('Nombre del rol del usuario');
            $table->text('description');
            $table->timestamps();


        });
        Schema::create('users', function(Blueprint $table){
            $table->increments('id');

            $table->unsignedInteger('role_id')->default(\App\Role::STUDENT); // valor por defecto que va a tomar cualquier usuario que se regristre en la plataforma 

            $table->foreign('role_id')->references('id')->on('roles'); // tendra como refencia el id de la tabla role
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('picture')->nullable();

            //columnas del crashier
            //manejar subscripciones
            $table->string('stripe_id')->nullable(); // saber si el usuario esta registrado
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            

            $table->rememberToken();
            $table->timestamps();

        });

        Schema::create('subscriptions', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');

            $table->string('stripe_id');
            $table->string('stripe_plan');
            $table->integer('quantity');
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();

        });
        // usuarios que se quieran registrar por redes sociales
        Schema::create('user_social_accounts', function(Blueprint $table){
            $table->increments('id');
             $table->unsignedInteger('user_id');
             $table->foreign('user_id')->references('id')->on('users');
             $table->string('provider'); // github face.. etcc
             $table->string('provider_uid'); // el id del usuario de la red con la que se registró
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // cuando se use un migrate:rollback se eliminen las tablas creadas
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('user_social_accounts');
    }
}
