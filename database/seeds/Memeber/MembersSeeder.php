<?php

namespace Database\Seeds\Member;

use DB;
use Illuminate\Database\Seeder;

class MembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('members')->truncate();

        factory(\App\Member\Member::class, 10)->create();
    }
}
