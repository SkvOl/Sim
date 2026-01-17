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

        User::factory(1000)
        ->has(Contract::factory()->count(1), 'contract')
        ->create();        
    }
}
