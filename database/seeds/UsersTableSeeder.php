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
		factory(\App\User::class, 1)->create([
			'name' => 'admin',
			'email' => 'admin@admin.com',
			'password' => bcrypt('1234'),
		]);

		factory(\App\User::class, 1)->create([
			'name' => 'alex',
			'email' => 'alex@alex.com',
			'password' => bcrypt('1234'),
		]);

		factory(\App\User::class, 1)->create([
			'name' => 'grafitex',
			'email' => 'grafitex@grafitex.com',
			'password' => bcrypt('1234'),
		]);
    }
}
