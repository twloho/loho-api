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

    public function getPaginate($perPage, $sort, $filters)
    {
        $member = $this->member;

        // handle order by
        $order = $sort;
        $isDesc = 'ASC';

        if (strrpos($sort, '-') === 0) {
            $order = substr($sort, 1, strlen($sort) - 1);
            $isDesc = 'DESC';
        }

        if ($sort) {
            $member = $member->orderBy($order, $isDesc);
        }

        // handle filter
        $position = 0;
        collect($filters)->each(function($item, $key) use (&$member, $position) {
            if ($position === 0) {
                $member = $member->where($key, 'like', '%' . $item . '%');
            } else {
                $member = $member->orWhere($key, 'like', '%' . $item . '%');
            }
        });

        return $member->paginate($perPage);
    }
}
