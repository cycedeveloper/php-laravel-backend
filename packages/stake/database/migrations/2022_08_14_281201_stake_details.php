<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StakeDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        if (Schema::hasTable('dex_stake_details')) return;
        
        Schema::create('dex_stake_details', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('stake_id');
            $table->foreign('stake_id')
                  ->references('id')->on('dex_stakes')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('token_id');
            $table->foreign('token_id')
                ->references('id')->on('dex_tokens')
                ->onDelete('cascade');
            
            $table->string('period_type');

            $table->string('period_interval');

            $table->decimal('total_profits', 64, 8)->default(0);

            $table->string('profit_period_type');

            $table->string('profit_period_count');

            $table->decimal('percentile_profit', 64, 8)->default(0);

            $table->decimal('profit_period_amount', 64, 8)->default(0);

            $table->string('deserved_profit_period')->default(0);

            $table->decimal('deserved_profit', 64, 8)->default(0);

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
