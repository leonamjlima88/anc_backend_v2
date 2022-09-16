<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('size', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 100)->index();
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

        DB::table('size')->truncate();
        DB::table('size')->insert([
            [
                'id' => 1,
                'name' => 'PP',
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'P',
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'M',
                'created_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'G',
                'created_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'XG',
                'created_at' => now(),
            ],
            [
                'id' => 6,
                'name' => '34',
                'created_at' => now(),
            ],
            [
                'id' => 7,
                'name' => '36',
                'created_at' => now(),
            ],
            [
                'id' => 8,
                'name' => '38',
                'created_at' => now(),
            ],
            [
                'id' => 9,
                'name' => '40',
                'created_at' => now(),
            ],
            [
                'id' => 10,
                'name' => '42',
                'created_at' => now(),
            ],
            [
                'id' => 11,
                'name' => '44',
                'created_at' => now(),
            ],
            [
                'id' => 12,
                'name' => '46',
                'created_at' => now(),
            ],
            [
                'id' => 13,
                'name' => '48',
                'created_at' => now(),
            ],
            [
                'id' => 14,
                'name' => '50',
                'created_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('size');
    }
};
