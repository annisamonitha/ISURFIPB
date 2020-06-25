<?php

namespace App\Exports;

use App\Models\Data as DataModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class DataExport implements FromCollection
{
    // use Exportable;

    // public function __construct(int $field_id)
    // {
    //     $this->field_id = $field_id;
    // }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DataModel::all();
        // return DataModel::where('field_id', $this->field_id)->get();
    }
}
