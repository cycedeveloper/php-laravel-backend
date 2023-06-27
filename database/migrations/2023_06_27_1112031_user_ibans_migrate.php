<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserIbansMigrate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('dex_user_ibans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
                  
            $table->unsignedBigInteger('token_id');
            $table->foreign('token_id')
                ->references('id')->on('dex_tokens')
                ->onDelete('cascade');

                
            $table->string('iban');
            
            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id')
            ->references('id')->on('dex_banks')
            ->onDelete('cascade');


            $table->string('label');
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
        //
    }
}