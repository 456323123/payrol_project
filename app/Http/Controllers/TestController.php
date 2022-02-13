<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestMail;
class TestController extends Controller
{
    function Testmail()
    {
        $details = [
            'title' => 'Mail from payrol',
            'body' => 'This is for testing email using smtp'
        ];

        \Mail::to('naeemliaqatweb@gmail.com')->send(new TestMail($details));
        return 'send emial';
    }
}
