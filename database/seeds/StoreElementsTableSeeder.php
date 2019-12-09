<?php

use Illuminate\Database\Seeder;

class StoreElementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\StoreElement::class, 30)->create();
    }
}
