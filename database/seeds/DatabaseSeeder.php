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
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'nome' => "Felipe Braiani",
            'siape' => 2310754,
            'password' => bcrypt('2310754'),
            'perfil' => '3'
        ]);
    }
}
