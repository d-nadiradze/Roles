<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'add post',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'delete post',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'edit post',
            'guard_name' => 'web',
        ]);

        DB::table('permissions')->insert([
            'name' => 'view post',
            'guard_name' => 'web',
        ]);

        DB::table('roles')->insert([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin1234'),
            'admin'=> 1,
            'email_verified_at' => now(),
        ]);

        Post::factory()->count(10)->create();

    }
}
