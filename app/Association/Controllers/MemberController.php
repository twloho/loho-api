<?php

namespace App\Association\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Association\Member;

class MemberController extends Controller
{
    //
    public function index()
    {
        $members = Member::all();
        $data = [
            'meta' => [
                'status' => 200,
            ],
            'data' => $members,
        ];

        return response($data)
            ->withHeaders([
                'X-Total-Count' => $members->count(),
            ]);
    }
}
