<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    
    public function index(Request $request)
    {
        $data = hash_hmac('ripemd160', 'The quick brown fox jumped over the lazy dog.', 'secret');
        dd($data);
    }
}
