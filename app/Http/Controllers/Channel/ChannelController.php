<?php

namespace App\Http\Controllers\Channel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Channel as ChannelModel;
use App\Models\Field as FieldModel;
use App\Models\TokenModel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\CssSelector\Parser\Token;

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
                    'count_channel' => $count_channel
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
                'channel' => $channel
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $channel = ChannelModel::find($id);

        // return dd($request->all());

        $channel->update($request->all());

        return redirect('/channel')->with('sukses', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $channel = ChannelModel::find($id);
        $channel->delete();

        return redirect('/channel')->with('sukses', 'Data berhasil dihapus');
    }

    public function detail($id)
    {
        $channel = ChannelModel::find($id);
        $token = TokenModel::where('channel_id', '=', $id)->first();

        return view(
            'channel.detail',
            [
                'channel' => $channel,
                'token' => $token
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
