<?php

namespace Database\Seeds\Association;

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

        factory(\App\Association\Member::class, 100)->create();
    }
}
