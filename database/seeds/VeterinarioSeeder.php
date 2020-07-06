<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VeterinarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('veterinarios')->insert([
            'nome' => 'Letícia Hermont',
            'crmv' => 'MG',
            'especialidade_id' => 1
        ]);

        DB::table('veterinarios')->insert([
            'nome' => 'Priscila Nielsen',
            'crmv' => 'PR',
            'especialidade_id' => 2
        ]);
    }
}
