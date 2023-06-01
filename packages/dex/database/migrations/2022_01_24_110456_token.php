<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Token extends Migration
{   
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dex_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token_code');
            $table->string('token_name');
            $table->string('contract_address')->nullable();
            $table->string('contract_address_test')->nullable();
            $table->string('blockchain');
            $table->boolean('is_default')->default(false);
            $table->boolean('payable')->default(false);
            $table->boolean('withdrawable')->default(false);
            $table->boolean('disabled')->default(false);
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
        Schema::dropIfExists('tokens');
    }
}
