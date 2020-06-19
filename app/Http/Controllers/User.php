<?php

namespace App\Http\Controllers;

use App\Models\Channel as ChannelModel;
use App\Models\Field as FieldModel;
use App\Models\User as UserModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class User extends Controller
{
    public function index()
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Kamu harus login dulu');
        } else {
            $data_channel = ChannelModel::where('user_id', Session::get('user_id'))->get();
            // $data_channel = Channel::all();
            $count_channel = $data_channel->count();

            $data_field = new Collection();
            foreach ($data_channel as $channel) {
                $data_field = $data_field->merge(FieldModel::where('channel_id', $channel->id)->get());
            }

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

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {

        $email = $request->email;
        $password = $request->password;

        $data = UserModel::where('email', $email)->first();
        if ($data) { //apakah email tersebut ada atau tidak
            if (Hash::check($password, $data->password)) {
                Session::put('user_id', $data->id);
                Session::put('name', $data->name);
                Session::put('email', $data->email);
                Session::put('login', TRUE);

                return redirect('dashboard');
            } else {
                return redirect('login')->with('alert', 'Password atau Email, Salah !');
            }
        } else {
            return redirect('login')->with('alert', 'Password atau Email, Salah!');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('login')->with('alert', 'Kamu sudah logout');
    }

    public function register(Request $request)
    {
        return view('register');
    }

    public function registerPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|min:4|email|unique:users',
            'password' => 'required',
            'confirmation' => 'required|same:password',
        ]);

        $data =  new UserModel();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect('login')->with('alert-success', 'Kamu berhasil Register');
    }
}
