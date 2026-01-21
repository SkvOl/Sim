<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contract;
use App\Models\GroupSim;
use App\Models\User;
use App\Models\Sim;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        GroupSim::factory(4000)
        ->has(Sim::factory()->count(5), 'sim')
        ->create();

        Contract::factory(1000)
        ->has(User::factory()->count(3), 'users')
        ->create();        
    }
}
