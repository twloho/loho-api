<?php

namespace App\Association;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Member extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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

    protected $attributes = [
        'status' => 0,
    ];

    public function getBirthdayAttribute($value)
    {
        return Carbon::parse($value)->toIso8601String();
    }

    public function setBirthdayAttribute($value)
    {
        $date = Carbon::parse($value)->format('Y-m-d H:i:s');

        $this->attributes['birthday'] = $date;
    }
}
