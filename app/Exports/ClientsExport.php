<?php


namespace App\Exports;


use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientsExport implements FromCollection, WithHeadings
{
    protected $clients;
    protected $headingsFields = [];

    public function __construct($clients, $headingsFields)
    {
        $this->clients = $clients;
        $this->headingsFields = $headingsFields;
    }

    public function collection()
    {
        return new Collection($this->clients);
    }

    public function headings(): array
    {
        return $this->headingsFields;
    }
}
