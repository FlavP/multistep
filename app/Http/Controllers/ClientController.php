<?php

namespace App\Http\Controllers;

use App\Exports\ClientsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    /**
     * @param Request $request
     */
    public function export(Request $request){
        $aData = $request->all();
        $export = new ClientsExport([[1, 2, 3]], [['unu', 'doi', 'trei']]);
        return Excel::download($export, 'clients.xlsx');
    }
}
