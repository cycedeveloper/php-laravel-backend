<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RerralIncome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('dex_referral_income', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->notnullable();
        
            $table->unsignedBigInteger('uchild_id')->notnullable();

            $table->unsignedBigInteger('token_id');
            $table->foreign('token_id')
                ->references('id')->on('dex_tokens')
                ->onDelete('cascade');

            $table->string('level');

            $table->decimal('amount', 64, 8)->default(0);

            $table->decimal('org_amount', 64, 8)->default(0);

            $table->decimal('percent', 64, 2)->default(0);

            $table->string('type_ref');

            $table->string('related_id');
            
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
