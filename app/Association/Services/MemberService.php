<?php

namespace App\Association\Services;

use App\Association\Member;
use App\Association\Repositories\MemberRepository;
use App\Association\Validators\MemberValidator;

class MemberService
{
    protected $memberRepository;
    protected $memberValidator;

    public function __construct(MemberRepository $memberRepository, MemberValidator $memberValidator)
    {
        $this->memberRepository = $memberRepository;
        $this->memberValidator = $memberValidator;
    }

    public function getPaginator($perPage, $sort, $filters)
    {
        return $this->memberRepository->getPaginate($perPage, $sort, $filters);
    }

    public function create($memberData)
    {
        $this->memberValidator->validateCreateOrFail($memberData);

        return $this->memberRepository->create($memberData);
    }
}
