<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\Receipt;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::factory()->count(2)->create();
        User::factory()->count(2)->create();
        ProductType::factory()->count(8)->create();
        Product::factory()->count(5)->create();
        Receipt::factory()->count(10)->create();
    }
}
