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
        Schema::table('owned_tickets', function (Blueprint $table) {
            $table->integer('status')->default(0);
            $table->boolean('claimed')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('owned_tickets', function (Blueprint $table) {
            $table->string('status');
            $table->boolean('claimed');
        });
    }
};
