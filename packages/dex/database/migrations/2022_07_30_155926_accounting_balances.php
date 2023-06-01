<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AccountingBalances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('dex_accounting_balances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('token_id');
            $table->foreign('token_id')
                  ->references('id')->on('dex_tokens')
                  ->onDelete('cascade');
            $table->decimal('depts',64, 8)->default(0);
            $table->decimal('incomes',64, 8)->default(0);
            $table->decimal('outgoings', 64, 8)->default(0);
            $table->decimal('invoices', 64, 8)->default(0);
            $table->decimal('balance',64, 8)->default(0);
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
