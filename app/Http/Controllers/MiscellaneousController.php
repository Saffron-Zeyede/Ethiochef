<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MiscellaneousController extends Controller
{
    public function inbox(){
        return view('admin.inbox')->with('messages', Message::all());
    }
}
