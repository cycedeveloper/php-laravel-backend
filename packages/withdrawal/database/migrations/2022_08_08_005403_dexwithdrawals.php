<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Dexwithdrawals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('dex_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            
            $table->unsignedBigInteger('user_wallet_id');
            $table->foreign('user_wallet_id')
                ->references('id')->on('dex_user_wallets')
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
