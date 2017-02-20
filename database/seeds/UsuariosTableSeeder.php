<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $facker=Faker::create('App\User');
        $facker2=Faker::create('App\TipoUsuario');

        DB::table('tipousuarios')->insert([
            'tipousuario'=>'Administrador'
        ]);
        DB::table('tipousuarios')->insert([
            'tipousuario'=>'Operario'
        ]);

        DB::table('users')->insert([
            'tipousuario_id'=>1,
            'username'=>'ecae11',
            'password' => bcrypt('alexander'),
            'estado'=>1
        ]);
        DB::table('users')->insert([
            'tipousuario_id'=>1,
            'username'=>'patricia19',
            'password' => bcrypt('alexander'),
            'estado'=>1
        ]);
        DB::table('areas')->insert([
            'area'=>'Sistemas'
        ]);
        DB::table('areas')->insert([
            'area'=>'Administracion'
        ]);
        DB::table('personas')->insert([
            'nombre'=>'Erick Alexander Ivan',
            'apellidoPat'=>'Cruz',
            'apellidoMat'=>'Estrada',
            'area_id'=>1,
            'user_id'=>1,
            'email'=>'eric_cruz_estrada@hotmail.com',
            'estado'=>1

        ]);
        DB::table('personas')->insert([
            'nombre'=>'Patricial del Pilar',
            'apellidoPat'=>'Majuan',
            'apellidoMat'=>'Cunayque',
            'area_id'=>1,
            'user_id'=>2,
            'email'=>'danle5@hotmail.com',
            'estado'=>1

        ]);
        DB::table('ficha_tecnicas')->insert([
            'fabricante'=>'CAT',
            'marca'=>'CAT',
            'modelo'=>'D777B8',
            'Descripcion'=>'Cisterna de Agua',
            'serie'=>'1122-2222-333-4-44',
            'fechacompra'=>'2016-12-04',
            'path'=>'cisterna.jpg',
            'estado'=>1

        ]);
        DB::table('ficha_tecnicas')->insert([
            'fabricante'=>'CAT',
            'marca'=>'CAT',
            'modelo'=>'XFR455',
            'Descripcion'=>'DUMPER',
            'serie'=>'1122-2222-333-4-44',
            'fechacompra'=>'2016-12-04',
            'path'=>'dumpers.jpg',
            'estado'=>1

        ]);
        DB::table('asignar_maquinarias')->insert([
            'fichatecnica_id'=>1,
            'persona_id'=>1,
            'Descripcion'=>'Modulo 5',
            'estado'=>1

        ]);
        DB::table('asignar_maquinarias')->insert([
            'fichatecnica_id'=>2,
            'persona_id'=>2,
            'Descripcion'=>'Modulo 10',
            'estado'=>1

        ]);
        DB::table('proveedors')->insert([
            'ruc'=>'11111111111',
            'razonsocial'=>'INTERNO',
            'direccion'=>'XXXXX',
            'nombrecontacto'=>'XXXXX XXXX XXX',
            'email'=>'XXXXX@XXXXX.com',
            'celular'=>'111111111',
            'descripcion'=>'INTERNO',
            'estado'=>1

        ]);
        /*
        for ($i=0; $i < 20; $i++) {
            DB::table('users')->insert([
                'tipousuario_id'=>$facker->numberBetween($min = 1, $max = 2),
                'username'=>$facker->userName,
                'password' => bcrypt('alexander'),
                'estado'=>$facker->numberBetween($min = 0, $max = 1)
            ]);
        }*/



    }
}
