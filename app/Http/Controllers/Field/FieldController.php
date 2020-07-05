<?php

namespace App\Http\Controllers\Field;

use App\Exports\FieldExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Channel;
use App\Models\Data as DataModel;
use App\Models\Field as FieldModel;
use App\Models\TokenModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class FieldController extends Controller
{

    public function index()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu harus login dulu');
        } else {
            $data_field = new Collection();
            $data_channel = Channel::where('user_id', Session::get('user_id'))->get();

            foreach ($data_channel as $channel) {
                $data_field = $data_field->merge(FieldModel::where('channel_id', $channel->id)->get());
            }
            
            $channel = Channel::where('user_id', Session::get('user_id'))->first();
            // $data_field = FieldModel::where('channel_id', $channel->id)->get();
            $count_field = $data_field->count();

            return view(
                'field.index',
                [
                    'data_field' => $data_field,
                    'count_field' => $count_field,
                    'data_channel' => $data_channel
                ]
            );
        }
    }

    public function create(Request $request)
    {
        FieldModel::create($request->all());
        return redirect('/field')->with('sukses', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $field = FieldModel::find($id);
        $data_channel = Channel::where('user_id', Session::get('user_id'))->get();

        return view(
            'field.edit',
            [
                'field' => $field,
                'data_channel' => $data_channel
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $field = FieldModel::find($id);

        $field->update($request->all());

        return redirect('/field')->with('sukses', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $field = FieldModel::find($id);
        $field->delete();

        return redirect('/field')->with('sukses', 'Data berhasil dihapus');
    }

    public function show($id)
    {
        $data = FieldModel::find($id);

        return view(
            'data.show',
            [
                'data' => $data
            ]
        );
    }

    public function field()
    {
        return response()->json(FieldModel::get(), 200);
    }

    public function export_excel()
    {
        return Excel::download(new FieldExport, 'siswa.xlsx');
    }

    public function fieldById($id)
    {
        $field = FieldModel::find($id);
        if (is_null($field)) {
            return response()->json('Field not found', 404);
        }
        return response()->json($field, 200);
    }

    public function fieldSave(Request $request)
    {
        $tokenStatus = $this->checkToken($request, $request->channel_id);
        if ($tokenStatus) {
            $field = FieldModel::create($request->all());
            return response()->json($field, 201);
        } else {
            return response()->json(['message' => 'Token Invalid'], 401);
        }
    }

    public function fieldUpdate(Request $request, $id)
    {
        $tokenStatus = $this->checkToken($request, $request->channel_id);
        if ($tokenStatus) {
            $field = FieldModel::find($id);
            if (is_null($field)) {
                return response()->json('Field not found', 404);
            }
            $field->update($request->all());

            return response()->json($field, 200);
        } else {
            return response()->json(['message' => 'Token Invalid'], 401);
        }
    }

    public function fieldDelete(Request $request, FieldModel $field)
    {
        $tokenStatus = $this->checkToken($request, $field->channel_id);
        if ($tokenStatus) {
            $field->delete();

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
