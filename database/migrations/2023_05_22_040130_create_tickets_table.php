<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Run the migrations.
     */

    //  id: 票的唯一識別符號
    //  flight_id: 航班的唯一識別符號，用於關聯航班資訊
    //  seat_number: 座位號碼
    //  price: 票價
    //  holder_id: 持有人的唯一識別符號，用於關聯使用者資訊
    //  status: 票的狀態，如已出售、可用等
    //  created_at: 票的創建時間
    //  updated_at: 票的更新時間
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_id')->constrained('flights');
            $table->string('seat_number');
            $table->decimal('price', 8, 2);
            $table->foreignId('holder_id')->nullable()->constrained('users');
            $table->integer('status');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }

};
