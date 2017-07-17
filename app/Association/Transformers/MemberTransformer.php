<?php

namespace App\Association\Transformers;

use App\Association\Member;
use League\Fractal\TransformerAbstract;

class MemberTransformer extends TransformerAbstract
{
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
	public function transform(Member $member)
	{
	    return [
            'id' => (int) $member['id'],
            'type' => (int) $member['type'],
            'serial_number' => $member['serial_number'],
            'last_name' => $member['last_name'],
            'first_name' => $member['first_name'],
            'gender' => (int) $member['gender'],
            'identification' => $member['identification'],
            'birthday' => $member['birthday'],
            'email' => $member['email'],
            'home_phone_number' => $member['home_phone_number'],
            'cell_phone_number' => $member['cell_phone_number'],
            'postcode' => $member['postcode'],
            'city' => $member['city'],
            'zone' => $member['zone'],
            'address' => $member['address'],
            'contact_last_name' => $member['contact_last_name'],
            'contact_first_name' => $member['contact_first_name'],
            'contact_cell_phone_number' => $member['contact_cell_phone_number'],
        ];
	}
}
