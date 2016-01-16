<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

		$data = [
			[
				'id'			=> 1,
				'name'			=> 'admin',
				'description'	=> 'Main admin',
			],
		];

		foreach ($data as $row) {
			DB::table('roles')->insert($row);
		}
    }
}
