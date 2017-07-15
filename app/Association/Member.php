<?php

namespace App\Association;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'serial_number',
        'last_name',
        'first_name',
        'gender',
        'identification',
        'birthday',
        'email',
        'home_phone_number',
        'cell_phone_number',
        'postcode',
        'city',
        'zone',
        'address',
        'contact_last_name',
        'contact_first_name',
        'contact_cell_phone_number',
    ];
}
