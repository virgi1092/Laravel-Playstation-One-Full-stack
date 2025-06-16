<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Playstation;

class PlaystationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Playstation::create([
            'nama_playstation' => 'PlayStation 4',
            'jenis' => 'PS4',
            'harga_sewa_harian' => 90000,
            'stok' => 15,
            'foto_playstation' => 'playstation/playstation4.png'
        ]);

        Playstation::create([
            'nama_playstation' => 'PlayStation 3',
            'jenis' => 'PS3',
            'harga_sewa_harian' => 70000,
            'stok' => 20,
            'foto_playstation' => 'playstation/playstation3.png',
        ]);
    }
}