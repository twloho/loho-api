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

    public function getPaginate($perPage)
    {
        return $this->member->paginate($perPage);
    }
}
