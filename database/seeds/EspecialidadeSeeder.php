<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('especialidades')->insert([
            'nome' => 'Cardiologista',
            'descricao' => 'Médico responsável pelo coração.'
        ]);
    
        DB::table('especialidades')->insert([
            'nome' => 'Neurologista',
            'descricao' => 'Médico responsável pelo cérebro.'
        ]);
    }
}
