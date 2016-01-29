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
				'email'		=> 'ken.beano@gmail.com',
				'password'	=> bcrypt('aDC42KvtuWJfaTK'),
			],
			[
				'id'		=> 2,
				'name'		=> 'Milutin Milovanovic',
				'email'		=> 'milutin_milovanovic@yahoo.com',
				'password'	=> bcrypt('O5rG3bi4rKhVJ1j'),
			],
		];

		foreach ($data as $row) {
			DB::table('users')->insert($row);
		}
    }
}
