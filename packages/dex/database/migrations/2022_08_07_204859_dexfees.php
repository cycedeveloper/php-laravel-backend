<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Dexfees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('dex_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('token_id');
            $table->foreign('token_id')
                  ->references('id')->on('dex_tokens')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('fee_face_id');
            $table->foreign('fee_face_id')
                ->references('id')->on('dex_fee_faces')
                ->onDelete('cascade');
                
            $table->string('related_id');
                
            $table->decimal('amount', 64, 8)->default(0);
            $table->string('for_type');
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
