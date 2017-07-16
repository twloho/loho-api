<?php

namespace App\Association\Controllers;

use App\Association\Repositories\MemberRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    protected $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    /**
     * @SWG\Get(
     *   path="/members",
     *   summary="Get member list",
     *   description="Member list.",
     *   tags={"member"},
     *   produces={"application/json"},
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
     *     @SWG\Schema(
     *       type="object",
     *       @SWG\Property(
     *         property="data",
     *         type="array",
     *         @SWG\Items(ref="#/definitions/Member")
     *       ),
     *       @SWG\Property(
     *         property="meta",
     *         type="object",
     *         @SWG\Property(property="status", type="integer", example=200)
     *       )
     *     )
     *   )
     * )
     */
    public function index()
    {
        $members = $this->memberRepository->getAll();
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
