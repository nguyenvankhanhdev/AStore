<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'testuser',
            'username' => 'user@gmail.com',
            'email'=>'user@gmail.com',
            'password' => bcrypt('password'),
            ]);

        // Seed dữ liệu cho bảng storage_product với GB là chuỗi
        DB::table('storage_product')->insert([
            ['GB' => '64GB'],
            ['GB' => '128GB'],
            ['GB' => '256GB'],
            ['GB' => '512GB'],
            ['GB' => '1TB'],
        ]);

        // Seed dữ liệu cho bảng color_product với màu sắc dịch sang tiếng Việt
        DB::table('color_product')->insert([
            ['color' => 'Bạc'],
            ['color' => 'Xám không gian'],
            ['color' => 'Vàng'],
            ['color' => 'Vàng hồng'],
            ['color' => 'Xanh lá'],
            ['color' => 'Xanh da trời'],
            ['color' => 'Xám'],
            ['color' => 'Xanh dương đậm'],
            ['color' => 'Đỏ'],
            ['color' => 'Đen'],
            ['color' => 'Ánh sao'],
            ['color' => 'Tím'],
            ['color' => 'Xanh dương'],
            ['color' => 'Hồng'],
        ]);

         // Insert dữ liệu mẫu cho bảng categories
         DB::table('categories')->insert([
            ['name' => 'iPhone', 'slug' => 'iphone'],
            ['name' => 'iPad', 'slug' => 'ipad'],
            ['name' => 'MacBook', 'slug' => 'macbook'],
            ['name' => 'Apple Watch', 'slug' => 'apple-watch'],
            ['name' => 'AirPods', 'slug' => 'airpods'],
        ]);
    }
}
