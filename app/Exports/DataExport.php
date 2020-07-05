<?php

namespace App\Exports;

use App\Models\Data as DataModel;
use DateTime;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataExport implements FromCollection
{
    // use Exportable;
    protected $field_id;
    protected $mode;
    public function __construct(int $field_id, $mode = null)
    {
        $this->field_id = $field_id;
        $this->mode = $mode;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->mode !== null) {
            $dt = new DateTime();
            switch ($this->mode) {
                case 1:
                    $dt->modify('-1 hour');
                    break;
                case 2:
                    $dt->modify('-1 day');
                    break;
                case 3:
                    $dt->modify('-1 week');
                    break;
                case 4:
                    $dt->modify('-2 week');
                    break;
                case 5:
                    $dt->modify('-1 month');
                    break;
                case 6:
                    $dt->modify('-3 month');
                    break;
                default:
                    $dt->modify('-1 hour');
                    break;
            }
            return DataModel::select(DB::raw('*, cast(concat(date, " ", time) as datetime) as `dtime`'))
                ->where('field_id', '=', $this->field_id)
                ->having('dtime', '>=', $dt->format('Y-m-d H:i:s'))
                ->having('dtime', '<=', date('Y-m-d H:i:s'))->orderBy('dtime', 'ASC')->get();
        }
        // return DataModel::all();
        return DataModel::where('field_id', $this->field_id)->get();
    }
}
