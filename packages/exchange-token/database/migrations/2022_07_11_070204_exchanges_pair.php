<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExchangesPair extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('dex_exchange_pairs', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->unsignedBigInteger('base_asset');
            $table->foreign('base_asset')
                ->references('id')->on('dex_tokens')
                ->onDelete('cascade');

            $table->unsignedBigInteger('quote_asset');
            $table->foreign('quote_asset')
                ->references('id')->on('dex_tokens')
                ->onDelete('cascade');

            $table->decimal('price', 64, 8)->default(0);

            $table->decimal('min_tradable', 64, 8)->default(0);

            $table->decimal('max_tradable', 64, 8)->default(0);

            $table->unsignedBigInteger('fee_face_id')->nullable();
            $table->foreign('fee_face_id')
                ->references('id')->on('dex_exchange_fee_faces')
                ->onDelete('cascade');

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
