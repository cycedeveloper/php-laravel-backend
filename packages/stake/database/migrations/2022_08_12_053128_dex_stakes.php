<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DexStakes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('dex_stakes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('stake_plan_id');
            $table->foreign('stake_plan_id')
                  ->references('id')->on('dex_stakes_plans')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');

            $table->string('amount');
            
            $table->timestamp('start_date')->nullable();

            $table->timestamp('end_date')->nullable();

            $table->string('status')->nullable()->default('wait');
            
            $table->boolean('has_referral')->nullable()->default(true); 

            $table->string('admin_note')->nullable();
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
