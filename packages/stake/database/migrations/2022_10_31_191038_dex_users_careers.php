<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DexUsersCareers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('dex_users_careers_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('career_id');
            $table->foreign('career_id')
                    ->references('id')->on('dex_careers')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('term_id');
            $table->foreign('term_id')
                    ->references('id')->on('dex_careers_terms')
                    ->onDelete('cascade');
            
            $table->json('term_details');
            
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
