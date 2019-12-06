<?php

namespace App\Http\Controllers;

use App\Exports\ClientsExport;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    private $clientRepo;

    /**
     * StaffController constructor.
     */
    public function __construct()
    {
        $this->clientRepo = new ClientRepository();
    }

    /**
     * @param Request $request
     */
    public function export(Request $request){
        $aData = $request->all();
        $headers = [
            'Id',
            'Name',
            'Age',
            'Email',
            'Married',
            'Partner Name'
        ];
        $clientRecords = $this->clientRepo->getClients($aData);
        $export = new ClientsExport($clientRecords->get(), $headers);
        return Excel::download($export, 'clients.xlsx');
    }
}
