<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DataFilter;

class DataFilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataFilter::create([
            'table_name' => 'dim_customer',
            'column_name' => 'Group',
            'possible_values' => json_encode(["Retail", "HORECA", "Economy"]),
        ]);

        DataFilter::create([
            'table_name' => 'dim_customer',
            'column_name' => 'region_group',
            'possible_values' => json_encode(["Eastern", "Western", "Mt Kenya", "Naivasha - Nakuru", "Mombasa"]),
        ]);
    }
}
