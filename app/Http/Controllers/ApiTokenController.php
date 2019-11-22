<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiTokenController extends Controller
{
    public function generate() {

        $token = Hash::make(now());

        return '{"token":"'.$token.'"}';
    }
}
