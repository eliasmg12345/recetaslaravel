<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        /*
        //SIN MODELO
        
        DB::table('users')->insert([
            'name' => 'elias',
            'email' => 'elias@elias.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://elias.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'sara',
            'email' => 'sara@sara.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://sara.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'vivi',
            'email' => 'vivi@vivi.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://vivi.com',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        */

        //Q1 Con modelo ...
        $user=User::create([
            'name'=>'elias',
            'email'=>'elias@elias.com',
            'password'=>Hash::make('12345678'),
            'url'=>'http://elias.com'
        ]);
        $user->perfil()->create();

        $user2=User::create([
            'name' => 'sara',
            'email' => 'sara@sara.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://sara.com'
        ]);
        $user2->perfil()->create();

        $user3=User::create([
            'name' => 'vivi',
            'email' => 'vivi@vivi.com',
            'password' => Hash::make('12345678'),
            'url' => 'http://vivi.com'
        ]);
        $user3->perfil()->create();
    }
}
