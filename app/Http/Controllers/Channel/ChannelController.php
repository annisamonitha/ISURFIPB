<?php

namespace App\Http\Controllers\Channel;
date_default_timezone_set('Asia/Jakarta');
use App\Models\Data;

use App\Http\Controllers\Controller;
use App\Models\Channel as ChannelModel;
use App\Models\TokenModel;
use App\Models\Field;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\CssSelector\Parser\Token;
use Illuminate\Support\Facades\DB;
use DateTime;

class ChannelController extends Controller
{
    public function index()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu harus login dulu');
        } else {
            $data_channel = ChannelModel::where('user_id', Session::get('user_id'))->get();
            // $data_channel = DB::table('channels')->where('user_id', 2);
            $count_channel = $data_channel->count();

            return view(
                'channel.index',
                [
                    'data_channel' => $data_channel,
                    'count_channel' => $count_channel,
                ]
            );
        }
    }

    public function create(Request $request)
    {
        ChannelModel::create($request->all());
        return redirect('/channel')->with('sukses', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $channel = ChannelModel::find($id);

        return view(
            'channel.edit',
            [
                'channel' => $channel,
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $channel = ChannelModel::find($id);

        $channel->update($request->all());

        return redirect('/channel')->with('sukses', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $channel = ChannelModel::find($id);
        $channel->delete();

        return redirect('/channel')->with('sukses', 'Data berhasil dihapus');
    }

    public function data(Request $request)
    { 
        $dt = new DateTime();
        switch($request->mode) {
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
        $data = [];
        foreach( Data::select(DB::raw('*, cast(concat(date, " ", time) as datetime) as `dtime`'))
        ->where('field_id', '=', $request->id)
        ->having('dtime', '>=', $dt->format('Y-m-d H:i:s'))
        ->having('dtime', '<=', date('Y-m-d H:i:s'))->orderBy('dtime', 'ASC')->get() as $d) {
            $data[] = $d;
        }
        return $data;
    }

    public function detail($id)
    {
        $channel = ChannelModel::find($id);
        $token = TokenModel::where('channel_id', '=', $id)->first();
        $field = Field::where('channel_id', '=', $id)->get();

        return view(
            'channel.detail',
            [
                'channel' => $channel,
                'token' => $token,
                'field' => $field,
            ]
        );

        // return view(
        //     'channel.edit',
        //     [
        //         'channel' => $channel
        //     ]
        // );
        // $data_channel = ChannelModel::all();
        // $count_channel = $data_channel->count();

        // $data_field = FieldModel::all();
        // $count_field = $data_field->count();

        // return view(
        //     'channel.detail',
        //     [
        //         'channel' => $channel
        //     ]
        // );
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

    // API Controller
    public function channel()
    {
        return response()->json(ChannelModel::get(), 200);
    }

    public function channelById($id)
    {
        $channel = ChannelModel::find($id);
        if (is_null($channel)) {
            return response()->json('Channel not found', 404);
        }
        return response()->json($channel, 200);
    }

    public function channelSave(Request $request)
    {
        $channel = ChannelModel::create($request->all());
        return response()->json($channel, 201);
    }

    public function channelUpdate(Request $request, $id)
    {
        $tokenStatus = $this->checkToken($request, $id);
        if ($tokenStatus) {
            $channel = ChannelModel::find($id);
            if (is_null($channel)) {
                return response()->json('Channel not found', 404);
            }
            $channel->update($request->all());

            return response()->json($channel, 200);
        } else {
            return response()->json(['message' => 'Token Invalid'], 401);
        }
    }

    public function channelDelete(Request $request, ChannelModel $channel)
    {
        $tokenStatus = $this->checkToken($request, $channel->id);
        if ($tokenStatus) {
            $channel->delete();

            return response()->json("Delete Success", 204);
        } else {
            return response()->json(['message' => 'Token Invalid'], 401);
        }
    }

    public function checkToken($request, $id)
    {
        $tokenModel = TokenModel::where('channel_id', '=', $id)->first();
        if ($tokenModel != null) {
            $token = $request->header('Authorization');
            $token_db = "Bearer " . $tokenModel->token;

            if ($token == $token_db) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
