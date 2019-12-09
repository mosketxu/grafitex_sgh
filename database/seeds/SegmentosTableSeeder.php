<?php

use Illuminate\Database\Seeder;

class SegmentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('segmentos')->delete();

        DB::table('segmentos')->insert([
            ['segmento'=>'Gold'],
            ['segmento'=>'Outlet'],
            ['segmento'=>'Platinum'],
            ['segmento'=>'Silver'],
            ]);
        }
    }