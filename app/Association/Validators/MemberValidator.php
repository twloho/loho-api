<?php

namespace App\Association\Validators;

use App\Association\Exceptions\MemberException;

class MemberValidator
{
    private $createRule = [
        'last_name' => 'required',
        'first_name' => 'required',

        'gender' => 'required|integer|in:0,1',
        'identification' => 'required',
        'birthday' => 'required|date',
        'email' => 'required|email',
        'cell_phone_number' => 'required',
        'home_phone_number' => 'required',

        'postcode' => 'required',
        'city' => 'required',
        'zone' => 'required',
        'address' => 'required',
        'contact_last_name' => 'required',
        'contact_first_name' => 'required',
        'contact_cell_phone_number' => 'required',
    ];

    /**
     * @SWG\Definition(
     *   definition="MemberException",
     *   type="object",
     *   required="['id']",
     *   @SWG\Property(property="source", type="object",
     *    @SWG\Property(property="pointer", type="string"),
     *   ),
     *   @SWG\Property(property="title", type="string"),
     *   @SWG\Property(property="detail", type="string"),
     * )
     */

    private function formatErrors($validator)
    {
        $errors = $validator->errors();

        $formated = collect($validator->failed())->map(function($item, $key) use ($errors) {
            return [
                'source' => [
                    'pointer' => '/data/attributes/' . $key,
                ],
                'title' => $errorType = key($item),
                'detail' => $errors->first($key),
            ];
        })->toArray();

        return $formated;
    }

    public function validateCreateOrFail($memberData) {
        $validator = \Validator::make($memberData, $this->createRule);

        if ($validator->fails()) {
            $errors = $this->formatErrors($validator);

            throw new MemberException($errors);
        }

        return true;
    }
}
