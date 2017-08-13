<?php

namespace App\Association\Controllers;

use App\Association\Transformers\MemberTransformer;
use App\Association\Services\MemberService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager as FractalManager;
use League\Fractal\Resource\Collection;
use League\Fractal\Serializer\JsonApiSerializer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class MemberController extends Controller
{
    protected $memberService;
    protected $fractal;

    public function __construct(MemberService $memberService, FractalManager $fractal)
    {
        $this->memberService = $memberService;
        $this->fractal = $fractal;
        $this->fractal->setSerializer(new JsonApiSerializer(url('')));
    }

    /**
     * @SWG\Get(
     *   path="/members",
     *   summary="Get member list",
     *   description="Member list.",
     *   tags={"member"},
     *   produces={"application/vnd.api+json"},
     *   @SWG\Parameter(in="query", name="page", type="number"),
     *   @SWG\Parameter(in="query", name="perPage", type="number"),
     *   @SWG\Parameter(in="query", name="sort", type="string"),
     *   @SWG\Parameter(in="query", name="filter[]", type="string"),
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
     *         @SWG\Property(property="status", type="integer", example=200),
     *         @SWG\Property(
     *           property="pagination",
     *           type="object",
     *           @SWG\Property(property="total", type="integer", example=100),
     *           @SWG\Property(property="count", type="integer", example=10),
     *           @SWG\Property(property="per_page", type="integer", example=10),
     *           @SWG\Property(property="current_page", type="integer", example=1),
     *           @SWG\Property(property="total_pages", type="integer", example=10)
     *         )
     *       ),
     *       @SWG\Property(
     *         property="links",
     *         type="object",
     *         @SWG\Property(property="self", type="string"),
     *         @SWG\Property(property="first", type="string"),
     *         @SWG\Property(property="next", type="string"),
     *         @SWG\Property(property="last", type="string")
     *       ),
     *     )
     *   )
     * )
     */
    public function index(Request $request)
    {
        // Handle Request
        $perPage = $request->input('perPage', 10);
        $sort = $request->input('sort', null);
        $filters = $request->input('filter', []);

        // Get members
        $paginator = $this->memberService->getPaginator($perPage, $sort, $filters);
        $members = $paginator->getCollection();
        $total = $paginator->total();

        // Transformer
        $resource = new Collection($members, new MemberTransformer, 'members');
        $resource->setMeta([
            'status' => 200,
        ]);

        // Pagination
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));

        // Serializer
        $data = $this->fractal->createData($resource)->toJson();

        // Response
        return response($data)
            ->withHeaders([
                'Content-Type' => 'application/vnd.api+json',
            ]);
    }
}
