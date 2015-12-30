<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->delete();

		$data = [
			[
				'id'		=> 1,
				'name'		=> 'Kenold Beauplan',
				'email'		=> 'ken@foo.bar',
				'password'	=> bcrypt('112233'),
			],
			[
				'id'		=> 2,
				'name'		=> 'Milutin Milovanovic',
				'email'		=> 'milutin@foo.bar',
				'password'	=> bcrypt('112233'),
			],
		];

		foreach ($data as $row) {
			DB::table('users')->insert($row);
		}
    }
}
