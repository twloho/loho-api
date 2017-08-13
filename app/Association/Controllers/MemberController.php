<?php

namespace App\Association\Controllers;

use App\Association\Transformers\MemberTransformer;
use App\Association\Services\MemberService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Fractal\Manager as FractalManager;
use League\Fractal\Resource\Item;
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

    /**
     * @SWG\Post(
     *   path="/members",
     *   summary="Create new member",
     *   tags={"member"},
     *   produces={"application/vnd.api+json"},
     *   @SWG\Parameter(in="body", name="json",
     *     @SWG\Schema(
     *       @SWG\Property(property="last_name", type="string"),
     *       @SWG\Property(property="first_name", type="string"),
     *       @SWG\Property(property="gender", type="number"),
     *       @SWG\Property(property="identification", type="string"),
     *       @SWG\Property(property="birthday", type="date"),
     *       @SWG\Property(property="email", type="string"),
     *       @SWG\Property(property="cell_phone_number", type="string"),
     *       @SWG\Property(property="home_phone_number", type="string"),
     *       @SWG\Property(property="postcode", type="string"),
     *       @SWG\Property(property="city", type="string"),
     *       @SWG\Property(property="zone", type="string"),
     *       @SWG\Property(property="address", type="string"),
     *       @SWG\Property(property="contact_last_name", type="string"),
     *       @SWG\Property(property="contact_first_name", type="string"),
     *       @SWG\Property(property="contact_cell_phone_number", type="string")
     *     )
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
     *     @SWG\Schema(
     *       type="object",
     *       @SWG\Property(
     *         property="data",
     *         type="object",
     *         ref="#/definitions/Member"
     *       ),
     *       @SWG\Property(
     *         property="meta",
     *         type="object",
     *         @SWG\Property(property="status", type="integer", example=200)
     *       )
     *     )
     *   ),
     *   @SWG\Response(
     *     response=400,
     *     description="error operation",
     *     @SWG\Schema(
     *       type="object",
     *       @SWG\Property(
     *         property="errors",
     *         type="array",
     *         @SWG\Items(ref="#/definitions/MemberException")
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
    public function store(Request $request) {
        $memberAttributes = $request->input('data.attributes');
        $memberData = collect($memberAttributes)->only([
            'last_name',
            'first_name',

            'gender',
            'identification',
            'birthday',
            'email',
            'cell_phone_number',
            'home_phone_number',

            'postcode',
            'city',
            'zone',
            'address',
            'contact_last_name',
            'contact_first_name',
            'contact_cell_phone_number',
        ])->toArray();

        // Create member
        $member = $this->memberService->create($memberData);

        // Transformer
        $resource = new Item($member, new MemberTransformer, 'members');
        $resource->setMeta([
            'status' => 200,
        ]);

        // Serializer
        $responseJSON = $this->fractal->createData($resource)->toJson();

        // Response
        return response($responseJSON)
            ->withHeaders([
                'Content-Type' => 'application/vnd.api+json',
            ]);
    }
}
