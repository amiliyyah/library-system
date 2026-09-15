<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = [
            'Amel',
            'Lia',
            'Amy',
            'Dhani',
            'Baxchan',
        ];

        return view('members.index', compact('members'));
    }
}