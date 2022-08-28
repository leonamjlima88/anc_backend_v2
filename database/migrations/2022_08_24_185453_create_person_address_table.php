<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_address', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('person_id')
                ->constrained('person')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->tinyInteger('type')->nullable()->comment('[0-noTag, 1-delivery, 2-billing]');
            $table->string('zipcode', 10)->nullable();
            $table->string('address', 100)->index();
            $table->string('address_number', 15)->nullable();
            $table->string('complement', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->foreignId('city_id')->constrained('city');
            $table->string('reference_point', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_address');
    }
};
