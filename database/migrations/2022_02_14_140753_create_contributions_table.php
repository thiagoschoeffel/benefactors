<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('benefactor_id');
            $table->integer('record_number')->nullable();
            $table->date('year_month_reference')->nullable();
            $table->double('amount', 9, 2)->default(0);
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('benefactor_id')->references('id')->on('benefactors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contributions');
    }
}
