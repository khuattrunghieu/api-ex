<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthApiController extends Controller
{
    public function success($messager, $data = [], $token)
    {
        return response()->json([
            'message' => $messager,
            'data' => $data,
            'token' => $token
        ]);
    }
    public function show_error($messager)
    {
        return response()->json([
            'messager' => $messager,
            'data' => null
        ]);
    }

}
