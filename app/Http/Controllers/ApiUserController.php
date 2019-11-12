<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiUser;
use Validator;

class ApiUserController extends Controller
{
    public function profile(ApiUser $ApiUser) {
        return view('apiuser.profile', compact('ApiUser'));
    }

    public function store(ApiUser $ApiUser, Request $request) {
        
        $params = $request->only(['name', 'api_name', 'account_number']);

        $validator = Validator::make($params, [
            'name' => 'string',
            'api_name' => 'string',
            'account_number' => 'string'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors');
        }

        foreach ($params as $field => $val) {
            $ApiUser->$field = $val;
        }

        $ApiUser->save();

        return back();
    }

    public function create(Request $request) {

        // validate here

        $user = new ApiUser();
        $user->name = $request->name;
        $user->api_name = $request->api_name;
        $user->account_number = $request->account_number;
        $user->save();

        return back()->with('errors');
    }

    public function delete(ApiUser $ApiUser) {
        if ($ApiUser) {
            $ApiUser->delete();
        }
        return redirect()->route('home');
    }
}
