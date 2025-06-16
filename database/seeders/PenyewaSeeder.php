<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penyewa;
use Illuminate\Support\Facades\Hash;

class PenyewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Penyewa::create([
            'name' => 'Rafi Virgi',
            'email' => 'rafivirgi@gmail.com',
            'password' => Hash::make('password123')
        ]);

        Penyewa::create([
            'name' => 'Fadhil',
            'email' => 'fadhil123@gmail.com',
            'password' => Hash::make('password123')
        ]);
    }
}