<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TokenWithdrawalSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dex_tokens_withdrawal_settings', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('token_id');
            $table->foreign('token_id')
                ->references('id')->on('dex_tokens')
                ->onDelete('cascade');

            $table->unsignedBigInteger('fee_face_id')->nullable();
            $table->foreign('fee_face_id')
                ->references('id')->on('dex_fee_faces')
                ->onDelete('cascade');

            $table->decimal('min_amount', 64, 8)->default(0)->nullable();
            $table->decimal('max_amount', 64, 8)->default(0)->nullable();

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
        Schema::dropIfExists('dex_tokens_withdrawal_settings');
    }
}
