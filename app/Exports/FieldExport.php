<?php

namespace App\Exports;

use App\Models\Field as ModelsField;
use Maatwebsite\Excel\Concerns\FromCollection;

class FieldExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ModelsField::all();
    }
}
