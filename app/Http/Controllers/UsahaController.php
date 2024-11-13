<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsahasExport;

class UsahaController extends Controller
{
    public function exportUsaha(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(new UsahasExport($startDate, $endDate), 'data_ekraf_' . $startDate . '-' . $endDate . '.xlsx');
    }
}
