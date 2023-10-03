<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('internal_message_id')->nullable();
            $table->foreign('internal_message_id')->references('id')->on('internal_messages')->onDelete('cascade');
            $table->foreignId('sender_id')->nullable()->constrained('users');
            $table->foreignId('recipient_id')->nullable()->constrained('admins');
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
