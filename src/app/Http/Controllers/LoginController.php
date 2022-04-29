<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Show masuk page
     * 
     * @return \Illuminate\Http\Response
     */
    public function masuk()
    {
        return view('user.masuk');
    }

    /**
     * Masuk Action
     */
    public function masukAction(Request $request)
    {
        dd($request->all());
    }
}
