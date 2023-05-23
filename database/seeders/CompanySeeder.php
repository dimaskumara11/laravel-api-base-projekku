<?php

namespace Database\Seeders;

use App\Models\CompanyModel;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyModel::create([
            'sector_id' => 1,
            'name' => 'PT DIMAS KUMARA',
            'owner_name' => 'Dimas Kumara',
            'logo' => 'xxxx'
        ]);
    }
}
