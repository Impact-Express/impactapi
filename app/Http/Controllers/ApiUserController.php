<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ApiUser;

class ApiUserController extends Controller
{
    public function profile(ApiUser $ApiUser) {
        return view('apiuser.profile', compact('ApiUser'));
    }

    public function store(ApiUser $ApiUser, Request $request) {
        $ApiUser->name = $request->name;
        $ApiUser->save();

        return back();
    }
}
