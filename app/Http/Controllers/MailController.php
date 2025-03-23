<?php

namespace App\Http\Controllers;

use App\Mail\EMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        Mail::to('mamofideno@gmail.com')->send(new EMail([
            'title' => 'The Title',
            'body' => 'The Body',
        ]));
    }
}
