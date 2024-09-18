<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataFilter;

class DataFilterController extends Controller
{
    public function index(DataFilter $datafilter, Request $request)
    {
        $filters = DataFilter::where([
            ['table_name', '!=', Null],
            [
                function ($query) use ($request) {
                    if (($s = $request->search)) {
                        $query->orWhere('table_name', 'LIKE', '%' . $s . '%')->get();
                    }
                }
            ]
        ])->orderBy('table_name', 'asc')->paginate(10);

        return view('admin.filters.index', compact('filters'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'table_name' => 'required|string|max:50',
            'column_name' => 'required|string|max:50',
            'column_value' => 'required|string',
        ]);

        $column_value = trim($validated_data['column_value']); 
        $column_value_array = array_map('trim', explode(',', $column_value));

        DataFilter::create([
            'table_name' => $validated_data['table_name'],
            'column_name' => $validated_data['column_name'],
            'possible_values' => json_encode($column_value_array),
        ]);
    
        return back()->with('message', 'Data filter created successfully!');
    }

    public function destroy($id)
    {
        $datafilter = DataFilter::findOrFail($id);
        $datafilter->delete();
        
        return back()->with('message', 'Data filter deleted successfully!');
    }
}
