<?php

namespace App\Association\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Association\Member;

class MemberController extends Controller
{
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

    /**
     * @SWG\Definition(
     *   definition="Member",
     *   type="object",
     *   required="['id']",
     *   @SWG\Property(property="id", type="integer"),
     *   @SWG\Property(property="type", type="integer"),
     *   @SWG\Property(property="serial_number", type="string"),
     *   @SWG\Property(property="last_name", type="string"),
     *   @SWG\Property(property="first_name", type="string"),
     *   @SWG\Property(property="gender", type="integer"),
     *   @SWG\Property(property="identification", type="string"),
     *   @SWG\Property(property="birthday", type="string", format="date"),
     *   @SWG\Property(property="email", type="string"),
     *   @SWG\Property(property="home_phone_number", type="string"),
     *   @SWG\Property(property="cell_phone_number", type="string"),
     *   @SWG\Property(property="postcode", type="string"),
     *   @SWG\Property(property="city", type="string"),
     *   @SWG\Property(property="zone", type="string"),
     *   @SWG\Property(property="address", type="string"),
     *   @SWG\Property(property="contact_last_name", type="string"),
     *   @SWG\Property(property="contact_first_name", type="string"),
     *   @SWG\Property(property="contact_cell_phone_number", type="string")
     * )
     */
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
