<?php 

use Illuminate\Database\Seeder;
use Illuminate\Database\EloquentModel;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder {

	public function run() {

		DB::table('users')->insert([
			['id' => 1, 'name' => "admin", 'email' => 'admin@example.com', 'password' => bcrypt('password'), 'created_at' => new Carbon, 'updated_at' => new Carbon],
			['id' => 2, 'name' => "user1", 'email' => 'user1@example.com', 'password' => bcrypt('password'), 'created_at' => new Carbon, 'updated_at' => new Carbon],
			['id' => 3, 'name' => "user2", 'email' => 'user2@example.com', 'password' => bcrypt('password'), 'created_at' => new Carbon, 'updated_at' => new Carbon]
		]);

	}

}