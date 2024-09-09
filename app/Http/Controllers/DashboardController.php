<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        
        $accessToken = session('azure_access_token');
        $reportId = config('services.azure.report_id');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'Accept' => 'application/json',
        ])->get('https://api.powerbi.com/v1.0/myorg/reports/' . $reportId);

        if ($response->getStatusCode() == 200) {
            $report = $response->json();
            return view('dashboard', ['report' => $report]);
        }

        return view('dashboard');
    }
}