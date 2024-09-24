<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssociatedAzure;
use Illuminate\Support\Facades\Crypt;

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
            'password' => 'eyJpdiI6InpaRVpGZUtEN2ppTzNrMWo0VDBUZUE9PSIsInZhbHVlIjoiaWhjdVA0L0tyM2IyclZ1SG85NUtJUT09IiwibWFjIjoiY2ZlMWYzMjVlMTE0NDhjODBmMjk4NmM5MGQyZjA5ZDM0ZDk4ZTBkZWExMzc5YzMyNmM1MjZkOTlhMTNlZDM0YiIsInRhZyI6IiJ9',
        ]);
    }
}
