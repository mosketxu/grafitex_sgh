<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();

        DB::table('countries')->insert([
            ['id'=>'ES','country'=>'ES'],
            ['id'=>'PT','country'=>'PT'],
        ]);
    }
}
