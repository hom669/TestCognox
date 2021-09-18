<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sizes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->id('id_size');
            $table->string('size');
            $table->timestamps();
        });

        DB::table("sizes")
            ->insert([
                "size" => "S"
            ]);

        DB::table("sizes")
        ->insert([
            "size" => "M"
        ]);

        DB::table("sizes")
            ->insert([
                "size" => "L"
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sizes');
    }
}
