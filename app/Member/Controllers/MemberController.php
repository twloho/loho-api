<?php

namespace App\Member\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member\Member;

class MemberController extends Controller
{
    //
    public function index()
    {
        return [
            'meta' => [
                'status' => 200,
            ],
            'data' => Member::all()
        ];
    }
}
