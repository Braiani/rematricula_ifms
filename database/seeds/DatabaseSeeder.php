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
            'nome' => "Felipe Gustavo Braiani Santos",
            'siape' => 2310754,
            'password' => bcrypt('2310754'),
            'perfil' => '3'
        ]);
        DB::table('cursos')->insert(['nome' => "Técnico em Mecânica"]);
        DB::table('cursos')->insert(['nome' => "Técnico em Informática"]);
        DB::table('cursos')->insert(['nome' => "Técnico em Eletrotécnica"]);
    }
}
