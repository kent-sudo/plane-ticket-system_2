<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // id: 唯一識別符號
    // content: 資訊內容
    // show : 顯示内容
    // created_at: 資訊創建時間
    // updated_at: 資訊更新時間
    public function up()
    {
        Schema::create('marquees', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->integer('show');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('marquees');
    }
};
