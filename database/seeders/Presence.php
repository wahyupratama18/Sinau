<?php

namespace Database\Seeders;

use App\Models\Presence as ModelsPresence;
use Illuminate\Database\Seeder;

class Presence extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Hadir', 'Terlambat', 'Sakit', 'Izin', 'Alpa'] as $value) {
            ModelsPresence::create(['type' => $value]);
        }
    }
}
