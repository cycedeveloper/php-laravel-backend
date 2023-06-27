<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DexWithdrawalsFiat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //


        Schema::create('dex_withdrawal_fiats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            
            $table->unsignedBigInteger('user_iban_id');
            $table->foreign('user_iban_id')
                ->references('id')->on('dex_user_ibans')
                ->onDelete('cascade');

            $table->unsignedBigInteger('token_id');
            $table->foreign('token_id')
                ->references('id')->on('dex_tokens')
                ->onDelete('cascade');
            
            $table->string('txt_id')->nullable();

            $table->string('status');

            $table->string('admin_not')->nullable();

            $table->decimal('amount', 64, 8)->default(0);

            $table->decimal('amount_fee', 64, 8)->default(0);

            $table->decimal('total', 64, 8)->default(0);
            
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