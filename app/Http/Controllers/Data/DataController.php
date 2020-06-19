<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Data as DataModel;
use App\Models\Field;
use App\Models\TokenModel;
use Symfony\Component\VarDumper\Cloner\Data;

class DataController extends Controller
{
    public function data()
    {
        return response()->json(DataModel::get(), 200);
    }

    public function dataById($id)
    {
        $data = DataModel::find($id);
        if (is_null($data)) {
            return response()->json('Data not found', 404);
        }
        return response()->json($data, 200);
    }

    public function dataSave(Request $request)
    {
        $tokenStatus = $this->checkToken($request, $request->field_id);
        if ($tokenStatus) {
            $data = DataModel::create($request->all());
            return response()->json($data, 201);
        } else {
            return response()->json(['message' => 'Token Invalid'], 401);
        }
    }

    public function dataUpdate(Request $request, $id)
    {
        $tokenStatus = $this->checkToken($request, $request->field_id);
        if ($tokenStatus) {
            $data = DataModel::find($id);
            if (is_null($data)) {
                return response()->json('Field not found', 404);
            }
            $data->update($request->all());

            return response()->json($data, 200);
        } else {
            return response()->json(['message' => 'Token Invalid'], 401);
        }
    }

    public function dataDelete(Request $request, DataModel $data)
    {
        $tokenStatus = $this->checkToken($request, $data->field_id);
        if ($tokenStatus) {
            $data->delete();

            return response()->json("Delete Success", 204);
        } else {
            return response()->json(['message' => 'Token Invalid'], 401);
        }
    }

    public function checkToken($request, $id)
    {
        $dataModel = DataModel::where('field_id', '=', $id)->first();
        if ($dataModel != null) {
            $fieldModel = Field::find($dataModel->channel_id);
            if ($fieldModel != null) {
                $tokenModel = TokenModel::where('channel_id', '=', $fieldModel->channel_id)->first();
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
            } else {
                return false;
            }
        } else {
            return false;
        }
        // $tokenModel = TokenModel::where('channel_id', '=', $id)->first();
        // if ($tokenModel != null) {
        //     $token = $request->header('Authorization');
        //     $token_db = "Bearer " . $tokenModel->token;

        //     if ($token == $token_db) {
        //         return true;
        //     } else {
        //         return false;
        //     }
        // } else {
        //     return false;
        // }
    }
}
