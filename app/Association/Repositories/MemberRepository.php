<?php

namespace App\Association\Repositories;

use App\Association\Member;

class MemberRepository
{
    protected $member;

    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    public function getAll()
    {
        return $this->member->all();
    }
}
