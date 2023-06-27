<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Banks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('dex_banks', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name');
            $table->string('bank_code');
            $table->string('bank_icon')->nullable();
            $table->string('default_iban')->nullable();
            $table->string('default_iban_description')->nullable();
            $table->boolean('payable')->default(false);
            $table->boolean('withdrawable')->default(false);
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