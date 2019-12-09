<?php

use Illuminate\Database\Seeder;

class CarteleriasTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('cartelerias')->delete();

    DB::table('cartelerias')->insert([
        ['carteleria'=>'Glorifier'],
        ['carteleria'=>'info no necesaria'],
        ['carteleria'=>'Insert Gogo'],
        ['carteleria'=>'Insert Gogo 2.0'],
        ['carteleria'=>'Insert gogo Córner'],
        ['carteleria'=>'Insert gogo Córner 1'],
        ['carteleria'=>'Insert gogo Córner 3'],
        ['carteleria'=>'Insert Gogo Intermediate'],
        ['carteleria'=>'Insert Tray vitrina Ray Ban'],
        ['carteleria'=>'Insert Tray vitrina Ray Ban cuadrada'],
        ['carteleria'=>'Insert Tray vitrina Ray Ban rectangular'],
        ['carteleria'=>'L story telling'],
        ['carteleria'=>'Large gogo cling'],
        ['carteleria'=>'Large tray insert '],
        ['carteleria'=>'Light box'],
        ['carteleria'=>'Logo'],
        ['carteleria'=>'Logo cajón'],
        ['carteleria'=>'Logo Ray Ban '],
        ['carteleria'=>'Logos'],
        ['carteleria'=>'Lona'],
        ['carteleria'=>'Medium gogo cling'],
        ['carteleria'=>'MKS'],
        ['carteleria'=>'MKS Ray Ban'],
        ['carteleria'=>'no necesaria info'],
        ['carteleria'=>'Pantalla'],
        ['carteleria'=>'PMS'],
        ['carteleria'=>'PMS (1)'],
        ['carteleria'=>'PMS (2)'],
        ['carteleria'=>'PMS (3)'],
        ['carteleria'=>'Polar Channel Graphics'],
        ['carteleria'=>'Rectangular Tray Insert'],
        ['carteleria'=>'Small gogo cling'],
        ['carteleria'=>'Small gogo cling negro'],
        ['carteleria'=>'Small gogo cling texto'],
        ['carteleria'=>'Square tray insert'],
        ['carteleria'=>'Storytelling'],
        ['carteleria'=>'Storytelling Ray Ban'],
        ['carteleria'=>'Survival Kit'],
        ['carteleria'=>'Tela Tensada'],
        ['carteleria'=>'Tela tensada Instronic'],
        ['carteleria'=>'Totem'],
        ['carteleria'=>'Vinilo campaña'],
        ['carteleria'=>'Window Banner'],
        ['carteleria'=>'Window Violator'],
        ['carteleria'=>'Window Violator RB'],
      ]);
    }
  }
  