<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            [
                'name' => 'Kosong',
                'color_code' => '#28a745', // Hijau
            ],
            [
                'name' => 'Terisi',
                'color_code' => '#dc3545', // Merah
            ],
            [
                'name' => 'Hampir Selesai',
                'color_code' => '#ffc107', // Kuning
            ],
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
