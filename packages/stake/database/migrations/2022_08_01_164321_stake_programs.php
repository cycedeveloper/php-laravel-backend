<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StakePrograms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dex_stakes_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->unsignedBigInteger('token_id');
            $table->foreign('token_id')
                  ->references('id')->on('dex_tokens')
                  ->onDelete('cascade');
            
            $table->string('period_type');
            $table->string('period_interval');
            $table->string('profit_period_type');
            
            $table->string('percentile_profit');

            $table->decimal('min_amount', 64, 8)->default(0);

            $table->decimal('max_amount', 64, 8)->default(0);

            $table->boolean('active')->default(true);

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
        Schema::dropIfExists('stakes_plans');
    }
}
