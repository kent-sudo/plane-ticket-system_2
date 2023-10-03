<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //id: 唯一識別符號
    // sender_id: 寄件人的唯一識別符號，用於關聯使用者資訊
    // recipient_id: 收件人的唯一識別符號，用於關聯使用者資訊
    // subject: 主題
    // content: 內容
    // created_at: 信件創建時間
    // updated_at: 資料更新時間
    public function up()
   {
        Schema::create('internal_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('internal_messages');
    }
};
