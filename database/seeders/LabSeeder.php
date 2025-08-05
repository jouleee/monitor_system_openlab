<?php

namespace Database\Seeders;

use App\Models\Lab;
use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = Status::all();
        
        $labs = [
            [
                'name' => 'Lab Komputer 1',
                'location' => 'Gedung A Lt. 1',
                'description' => 'Laboratorium komputer utama dengan 30 unit PC',
                'status_id' => $statuses->where('name', 'Kosong')->first()->id,
            ],
            [
                'name' => 'Lab Komputer 2',
                'location' => 'Gedung A Lt. 2',
                'description' => 'Laboratorium komputer sekunder dengan 25 unit PC',
                'status_id' => $statuses->where('name', 'Terisi')->first()->id,
            ],
            [
                'name' => 'Lab Jaringan',
                'location' => 'Gedung B Lt. 1',
                'description' => 'Laboratorium khusus untuk praktikum jaringan',
                'status_id' => $statuses->where('name', 'Hampir Selesai')->first()->id,
            ],
            [
                'name' => 'Lab Multimedia',
                'location' => 'Gedung B Lt. 2',
                'description' => 'Laboratorium untuk praktikum multimedia dan desain',
                'status_id' => $statuses->where('name', 'Kosong')->first()->id,
            ],
            [
                'name' => 'Lab Server',
                'location' => 'Gedung C Lt. 1',
                'description' => 'Laboratorium server dan database',
                'status_id' => $statuses->where('name', 'Terisi')->first()->id,
            ],
        ];

        foreach ($labs as $lab) {
            Lab::create($lab);
        }
    }
}
