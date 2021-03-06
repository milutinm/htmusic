<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
		$this->command->info('Users Table Seeded!');
		$this->call(DBSeeder::class);
		$this->command->info('CSV Seeded!');
		$this->call(RolesTableSeeder::class);
		$this->command->info('Roles Table Seeded!');
		$this->call(UserRoleTableSeeder::class);
		$this->command->info('UserRoles Table Seeded!');
    }
}
