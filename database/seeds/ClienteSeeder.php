<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'nome' => 'Julia Gouvêa',
            'telefone' => '99400-2334',
            'email' => 'julia@email.com'
        ]);

        DB::table('clientes')->insert([
            'nome' => 'Gil Eduardo',
            'telefone' => '99344-3455',
            'email' => 'gil@email.com',
        ]);
    }
}
