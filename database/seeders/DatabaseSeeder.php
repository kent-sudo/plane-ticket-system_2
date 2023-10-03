<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Admin;
use App\Models\Flight;
use App\Models\Ticket;
use App\Models\Wallet;
use App\Models\Marquee;
use App\Models\TicketRequest;
use App\Models\WalletDepositHistory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // 使用工厂类生成模型数据
        Admin::factory()->count(1)->create();
        // Wallet::factory()->count(10)->create();
        // Ticket::factory()->count(20)->create();
        // WalletDepositHistory::factory()->count(20)->create();
        // TicketRequest::factory()->count(10)->create();
        // Marquee::factory()->count(5)->create();

    }
}
