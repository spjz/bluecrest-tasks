<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TokenController extends Controller
{
    public function create(Request $request)
    {
        $token = $request->user()->createToken('tasks');

        return Redirect::route('profile.edit')->with([
            'status' => 'token-created',
            'token' => $token->plainTextToken
        ]);
    }
}
