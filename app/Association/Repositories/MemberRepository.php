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
    public function getAll()
    {
        return $this->member->all();
    }
}
