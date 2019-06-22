<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioAdm extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Dieggo Carrilho',
            'username' => 'dieggocarrilho',
            'password' => bcrypt('270287'),
        ]);
    }
}
