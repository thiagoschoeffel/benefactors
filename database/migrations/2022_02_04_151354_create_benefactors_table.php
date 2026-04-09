<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenefactorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefactors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->string('primary_phone')->nullable();
            $table->string('secondary_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('civil_state')->nullable();
            $table->text('note')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('spouse_birth_date')->nullable();
            $table->date('wedding_date')->nullable();
            $table->string('address_zip_code')->nullable();
            $table->string('address_street')->nullable();
            $table->integer('address_number')->nullable();
            $table->string('address_complement')->nullable();
            $table->string('address_neighborhood')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_state', 2)->nullable();
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
        Schema::dropIfExists('benefactors');
    }
}
