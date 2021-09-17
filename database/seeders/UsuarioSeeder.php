<?php

namespace Database\Seeders;

use App\Components\Biblioteca;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_cad_usuarios')->insert([
            'des_nome' => Str::random(10),
            'des_email' => Str::random(10) . '@gmail.com',
            'des_cpf' => Str::random(11),
            'password' => Hash::make(Str::random(10)),
            'flg_ativo' => Biblioteca::FLG_ATIVO,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
