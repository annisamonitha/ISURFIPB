<?php

namespace App\Http\Controllers\Token;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TokenModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;;

class TokenController extends Controller
{
    public function generate($id)
    {
        // $token = DB::table('table_token')->where('channel_id', $id)->first();
        $token = TokenModel::where('channel_id', '=', $id)->first();

        if ($token != null) {
            // $token->fill(['token' => Str::random(32)]);
            $token->token = Str::random(32);
            $token->save();
            // TokenModel::update($token->all());
            //     'id' => $token->id,
            //     'id' => $token->id,

            // ]);
            // $token->update(['token' => Str::random(32)]);

        } else {
            TokenModel::create([
                'channel_id' => $id,
                'token' => Str::random(32)
            ]);
            // return 'generate';
        }

        return redirect('channel/' . $id . '/detail');

        // return $id;
    }
}
