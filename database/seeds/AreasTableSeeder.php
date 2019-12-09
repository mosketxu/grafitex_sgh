<?php

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->delete();

        DB::table('areas')->insert([
            ['area'=>'Andalucía'],
            ['area'=>'Baleares'],
            ['area'=>'Canarias'],
            ['area'=>'Cataluña'],
            ['area'=>'Levante'],
            ['area'=>'Madrid'],
            ['area'=>'Norte'],
            ['area'=>'Portugal'],
            ['area'=>'Portugal 1'],
            ['area'=>'Portugal 2'],
            ['area'=>'Portugal 3'],
            ]);
        }
    }
    