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
        Schema::create('person', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('business_name', 100)->index();
            $table->string('alias_name', 100)->index();
            $table->string('ein', 20)->index();
            $table->tinyInteger('icms_taxpayer')->nullable();
            $table->string('state_registration', 20)->nullable();
            $table->string('municipal_registration', 20)->nullable();
            $table->string('zipcode', 10)->nullable();
            $table->string('address', 100)->index();
            $table->string('address_number', 15)->nullable();
            $table->string('complement', 100)->nullable();
            $table->string('district', 100);
            $table->foreignId('city_id')->constrained('city');
            $table->string('reference_point', 100)->nullable();
            $table->string('phone_1', 40)->nullable();
            $table->string('phone_2', 40)->nullable();
            $table->string('phone_3', 40)->nullable();
            $table->string('company_email', 100)->nullable();
            $table->string('financial_email', 100)->nullable();
            $table->string('internet_page', 255)->nullable();
            $table->text('note')->nullable();
            $table->text('bank_note')->nullable();
            $table->text('commercial_note')->nullable();
            $table->tinyInteger('is_customer')->nullable();
            $table->tinyInteger('is_seller')->nullable();
            $table->tinyInteger('is_supplier')->nullable();
            $table->tinyInteger('is_carrier')->nullable();
            $table->tinyInteger('is_technician')->nullable();
            $table->tinyInteger('is_employee')->nullable();
            $table->tinyInteger('is_other')->nullable();
            $table->tinyInteger('is_final_customer')->default(0);
            $table->timestamps();
            $table->foreignId('created_by_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('updated_by_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person');
    }
};
