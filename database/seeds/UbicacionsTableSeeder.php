<?php

use Illuminate\Database\Seeder;

class UbicacionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ubicacions')->delete();

        DB::table('ubicacions')->insert([
            ['ubicacion'=>'Front Door'],
            ['ubicacion'=>'In Store']
            ]);
        }
    }