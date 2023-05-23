<?php

namespace Database\Seeders;

use App\Models\SectorModel;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SectorModel::create([
            'name' => 'TEKNOLOGI',
        ]);
    }
}
