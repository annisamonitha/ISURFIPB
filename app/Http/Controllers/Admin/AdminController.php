<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Channel as ChannelModel;
use App\Models\Field as FieldModel;

class AdminController extends Controller
{
    public function dashboard()
    {
        $data_channel = ChannelModel::all();
        $count_channel = $data_channel->count();

        $data_field = FieldModel::all();
        $count_field = $data_field->count();
        return view(
            'admin.dashboard',
            [
                'data_channel' => $data_channel,
                'count_channel' => $count_channel,
                'data_field' => $data_field,
                'count_field' => $count_field
            ]
        );

        // return view('admin.dashboard');
    }
}
