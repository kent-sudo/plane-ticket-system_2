<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    //  id: 航班的唯一識別符號
    //  departure_time: 起飛時間
    //  arrival_time: 目的地
    //  destination: 目的地
    //  departure_location: 出發地
    //  created_at: 航班的創建時間
    //  updated_at: 航班的更新時間
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->string('flight_number');
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->string('destination');
            $table->string('departure_location');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('flights');
    }
};
