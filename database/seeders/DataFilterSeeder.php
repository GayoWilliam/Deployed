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
        $filters = [
            [
                'column_name' => 'Group',
                'possible_values' => json_encode(["Retail", "HORECA", "Economy"]),
            ],
            [
                'column_name' => 'region_group',
                'possible_values' => json_encode(["Eastern", "Western", "Mt Kenya", "Naivasha - Nakuru", "Mombasa"]),
            ]
        ];

        foreach ($filters as $filter) {
            DataFilter::create(array_merge(['table_name' => 'dim_customer'], $filter));
        }
    }
}