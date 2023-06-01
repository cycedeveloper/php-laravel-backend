<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreerTermDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dex_career_terms_details', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('term_id');
            $table->foreign('term_id')
                    ->references('id')->on('dex_careers_terms')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('career_id');
            $table->foreign('career_id')
                    ->references('id')->on('dex_careers')
                    ->onDelete('cascade');


            $table->decimal('value_num_1', 64, 8)->default(0)->nullable();

            $table->decimal('value_num_2', 64, 8)->default(0)->nullable();

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
        Schema::dropIfExists('dex_term_details');
    }
}
