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
        Schema::create('person_contact', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('person_id')
                ->constrained('person')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name', 80)->nullable();
            $table->string('ein', 20)->nullable();
            $table->string('type', 80)->nullable();
            $table->text('note')->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('email', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_contact');
    }
};
