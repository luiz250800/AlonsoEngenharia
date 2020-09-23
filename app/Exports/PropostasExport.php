<?php

namespace App\Exports;

use App\Models\Proposta;
use Maatwebsite\Excel\Concerns\FromCollection;

class PropostasExport implements FromCollection
{

    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->query;
    }
}
