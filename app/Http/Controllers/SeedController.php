<?php

namespace App\Http\Controllers;

date_default_timezone_set('Asia/Jakarta');
use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Data;
use App\Models\Field;
use DateTime;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SeedController extends Controller
{
    protected $intvrl = ' minute';
    protected $backward = '-7 day';

    public function seed()
    {
        $count = 0;
        foreach (Channel::all() as $channel) {
            foreach (Field::where('channel_id', '=', $channel->id)->get() as $field) {
                $dt = new DateTime();
                $dt->modify($this->backward );
                $last = Data::where(['field_id' => $field->id])->orderBy('date', 'DESC')->orderBy('time', 'DESC')->first();
                if ($last !== null) {
                    $dt = DateTime::createFromFormat('Y-m-d H:i:s', $last->date . ' ' . $last->time);
                }
                if (strpos(strtolower($field->sensor), 'temperature') !== false) {
                    $count_temp = rand(1, 3);
                    $json = File::get(storage_path('app/public/data/Temperature/Temperature' . $count_temp . '.json'));
                    print_r("DATA :  Temperature" . $count_temp . '.json<br>');
                    $json = '{ "data": [ ' . $json . ']}';
                    $data = json_decode($json, true);
                    //nilai, date, time, field id;
                    foreach ($data['data'] as $d) {
                        $dt->modify('+1 '.$this->intvrl);
                        $model = new Data;
                        $model->field_id = $field->id;
                        $model->date = $dt->format('Y-m-d');
                        $model->time = $dt->format('H:i:s');
                        $model->nilai = (int) $d['data'] + rand(-2, 2);
                        $model->save();
                        $count += 1;
                    }
                } elseif (strpos(strtolower($field->sensor), 'tds') !== false) {
                    $count_tds = rand(1, 3);
                    $json = File::get(storage_path('app/public/data/Total Dissolved Solids/TDS' . $count_tds . '.json'));
                    print_r("DATA :  TDS" . $count_tds . '.json<br>');
                    $json = '{ "data": [ ' . $json . ']}';
                    $data = json_decode($json, true);
                    //nilai, date, time, field id;
                    if (is_array($data) || is_object($data)) {
                        foreach ($data['data'] as $d) {
                            $dt->modify('+1 '.$this->intvrl);
                            $model = new Data;
                            $model->field_id = $field->id;
                            $model->date = $dt->format('Y-m-d');
                            $model->time = $dt->format('H:i:s');
                            $model->nilai = (int) $d['data'] + rand(-100, 100);
                            $model->save();
                            $count += 1;
                        }
                    } else {
                        print_r('error <br>');
                        print_r($data);
                        print_r('error <br>');
                    }
                } elseif (strpos(strtolower($field->sensor), 'ph') !== false) {
                    $count_ph = rand(1, 3);
                    $json = File::get(storage_path('app/public/data/PH/ph' . $count_ph . '.json'));
                    print_r("DATA :  ph" . $count_ph . '.json<br>');
                    $json = '{ "data": [ ' . $json . ']}';
                    $data = json_decode($json, true);
                    //nilai, date, time, field id;
                    foreach ($data['data'] as $d) {
                        $dt->modify('+1 '.$this->intvrl);
                        $model = new Data;
                        $model->field_id = $field->id;
                        $model->date = $dt->format('Y-m-d');
                        $model->time = $dt->format('H:i:s');
                        $model->nilai = (float) $d['data'] + (rand(-10, 10) / 10);
                        $model->save();
                        $count += 1;
                    }
                }
            }
        }
        print_r('DONE INSERT '. $count . ' RECORDS !');
    }

    public function test()
    {
        dd('x');
    }
}
