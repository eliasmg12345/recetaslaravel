<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
   /**
    * Run the database seeds.
    *
    * @return void
    */
   public function run()
   {
      //
      DB::table('categoria_recetas')->insert([
         'nombre' => 'comida mexicana',
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s'),
      ]);

      DB::table('categoria_recetas')->insert([
         'nombre' => 'comida argentinca',
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('categoria_recetas')->insert([
         'nombre' => 'comida brasiñea',
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('categoria_recetas')->insert([
         'nombre' => 'comida peruana',
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('categoria_recetas')->insert([
         'nombre' => 'comida boliviana',
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s'),
      ]);
      DB::table('categoria_recetas')->insert([
         'nombre' => 'picante',
         'created_at' => date('Y-m-d H:i:s'),
         'updated_at' => date('Y-m-d H:i:s'),
      ]);
   }
}
