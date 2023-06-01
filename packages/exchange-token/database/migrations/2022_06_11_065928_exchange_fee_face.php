<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExchangeFeeFace extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('dex_exchange_fee_faces', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->enum('base_type',['fixed','percent','none']);
            $table->decimal('base_fixed_amount', 64, 8)->nullable()->default(0);
            $table->decimal('base_percent_amount', 64, 8)->nullable()->default(0);

            $table->enum('quote_type',['fixed','percent','none']);
            $table->decimal('quote_base_fixed_amount', 64, 8)->nullable()->default(0);
            $table->decimal('quote_base_percent_amount', 64, 8)->nullable()->default(0);
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
