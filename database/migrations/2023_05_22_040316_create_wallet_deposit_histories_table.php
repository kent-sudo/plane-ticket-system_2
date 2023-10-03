<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('wallet_deposit_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('transaction_type');
            $table->unsignedBigInteger('wallet_id');
            $table->string('bank_code_account_number');
            $table->decimal('amount', 8, 2);
            $table->unsignedTinyInteger('status')->default(0);
            $table->text('remarks')->nullable();
            $table->timestamps();
        
            // Foreign key constraint
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('wallet_deposit_histories');
    }
};
