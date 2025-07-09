<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'user 1',
            'email' => 'user1@example.com',
            'password' => Hash::make('123'),
            'role' => 'user',
        ]);
        User::factory()->create([
            'name' => 'seller 1',
            'email' => 'seller1@example.com',
            'password' => Hash::make('123'),
            'role' => 'seller',
        ]);
        User::factory()->create([
            'name' => 'uec',
            'email' => 'uec@example.com',
            'password' => Hash::make('123'),
            'role' => 'uec',
        ]);
        User::factory()->create([
            'name' => 'admin 1',
            'email' => 'admin@example.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);

        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Makanan',
                'slug' => Str::slug('Makanan'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Minuman',
                'slug' => Str::slug('Minuman'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('products')->insert([
            [
                'id' => 1,
                'category_id' => 1,
                'seller_id' => 2,
                'product_name' => 'Bubur Ayam',
                'price' => 15000,
                'description' => 'Bubur ayam dengan topping ayam suwir, cakwe, dan sambal.',
                'stock' => 10,
                'image_url' => 'http://127.0.0.1:8000/uploads/products/1752096366.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'id' => 2,
                'category_id' => 2,
                'seller_id' => 2,
                'product_name' => 'Kopi Susu',
                'price' => 8000,
                'description' => 'Kopi susu dengan rasa yang kaya dan aroma yang menggoda.',
                'stock' => 10,
                'image_url' => 'http://127.0.0.1:8000/uploads/products/1752096520.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('detail_sellers')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'store_name' => 'Kupi dan Bubur bu ijah',
                'phone' => '081234567890',
                'store_address' => 'Jl. Sudut No. 10, Jakarta',
                'status' => 'approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'store_name' => 'Warung Es Teh Manis',
                'phone' => '082345678901',
                'store_address' => 'Jl. Minuman Segar No. 5, Bandung',
                'status' => 'rejected',
                'created_at' => '2025-07-05 09:00:00',
                'updated_at' => '2025-07-05 09:00:00',
            ],
        ]);
    }
}
