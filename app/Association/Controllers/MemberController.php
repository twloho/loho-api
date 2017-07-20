<?php

namespace App\Association\Controllers;

use App\Association\Transformers\MemberTransformer;
use App\Association\Services\MemberService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager as FractalManager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\JsonApiSerializer;

class MemberController extends Controller
{
    protected $memberService;
    protected $fractal;

    public function __construct(MemberService $memberService, FractalManager $fractal)
    {
        $this->memberService = $memberService;
        $this->fractal = $fractal;
        $this->fractal->setSerializer(new JsonApiSerializer());
    }

    /**
     * @SWG\Get(
     *   path="/members",
     *   summary="Get member list",
     *   description="Member list.",
     *   tags={"member"},
     *   produces={"application/vnd.api+json"},
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
        // Get members
        $members = $this->memberService->getList();

        // Transformer
        $resources = new Collection($members, new MemberTransformer, 'members');
        $resources->setMeta([
            'status' => 200,
            'total' => $members->count(),
        ]);

        // Serializer
        $data = $this->fractal->createData($resources)->toJson();

        // Response
        return response($data)
            ->withHeaders([
                'Content-Type' => 'application/vnd.api+json',
            ]);
    }
}
