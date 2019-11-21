<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiTokenController extends Controller
{
    public function generate() {
        return '{"token":"dfasdfasdfasfasdfasdf"}';
    }
}
