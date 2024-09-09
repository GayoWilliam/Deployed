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
}
