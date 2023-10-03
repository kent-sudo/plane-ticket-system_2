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
        Schema::table('users', function (Blueprint $table) {
            //$table->addColumn('integer', 'paid');
            $table->softDeletes('deleted_at');
        });
        Schema::table('tickets', function (Blueprint $table) {
            //$table->addColumn('integer', 'paid');
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes('deleted_at');
        });
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropSoftDeletes('deleted_at');
        });
    }
};
