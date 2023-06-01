<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DexExchangeOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dex_exchange_orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('pair_id');
            $table->foreign('pair_id')
                ->references('id')->on('dex_exchange_pairs')
                ->onDelete('cascade');
            
            $table->decimal('price', 64, 8)->default(0);

            $table->decimal('base_amount', 64, 8)->default(0);

            $table->decimal('quote_amount', 64, 8)->default(0);

            $table->decimal('base_fee_amount', 64, 8)->default(0);

            $table->decimal('quote_fee_amount', 64, 8)->default(0);

            $table->string('type');
            
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
        Schema::dropIfExists('dex_exchange_orders');
    }
}
