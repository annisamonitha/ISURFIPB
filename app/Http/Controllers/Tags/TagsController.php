<?php

namespace App\Http\Controllers\Tags;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TagModel;

class TagsController extends Controller
{
    public function index()
    {
        $data_channel = TagModel::all();
        $count_channel = $data_channel->count();

        // $data_field = FieldModel::all();
        // $count_field = $data_field->count();
        // return view(
        //     'channel.index',
        //     [
        //         'data_channel' => $data_channel,
        //         'count_channel' => $count_channel,
        //         'data_field' => $data_field,
        //         'count_field' => $count_field
        //     ]
        // );
    }
}
