<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function testMail()
    {
        Mail::to('alfredooeka@gmail.com')
            ->queue(new TestMail());
    }
}
