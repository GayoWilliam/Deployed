<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssociatedAzure;

class AzureAssociations extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssociatedAzure::create([
            'azure_account' => 'powerbi@kenchic.com',
            'account_type' => 'pro',
            'password' => 'Kenchic2024',
        ]);

    }
}
