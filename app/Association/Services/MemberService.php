<?php

namespace App\Association\Services;

use App\Association\Member;
use App\Association\Repositories\MemberRepository;

class MemberService
{
    protected $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function getPaginator($perPage, $sort)
    {
        return $this->memberRepository->getPaginate($perPage, $sort);
    }
}
