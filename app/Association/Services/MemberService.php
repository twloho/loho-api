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

    public function getList()
    {
        return $this->memberRepository->getAll();
    }
}
