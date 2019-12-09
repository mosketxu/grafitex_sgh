<?php

use Illuminate\Database\Seeder;

class StoreconceptsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('storeconcepts')->delete();

        DB::table('storeconcepts')->insert([
        ['storeconcept'=>'6000'],
        ['storeconcept'=>'2.0'],
        ['storeconcept'=>'2.0 + 6000'],
        ['storeconcept'=>'2.0 + 6000 +RB SIS'],
        ['storeconcept'=>'2.0 + RB SIS'],
        ['storeconcept'=>'2.0 + RB SIS + Promo table'],
        ['storeconcept'=>'2.0 + ZIGZAG (RB-OO)'],
        ['storeconcept'=>'2.0 Open Air'],
        ['storeconcept'=>'3.0'],
        ['storeconcept'=>'3.0 + RB SIS'],
        ['storeconcept'=>'3.0 + ZIGZAG (RB-OO)'],
        ['storeconcept'=>'3.0 Special'],
        ['storeconcept'=>'4.0 + RB SIS'],
        ['storeconcept'=>'6000 + RB SIS'],
        ['storeconcept'=>'Basic'],
        ['storeconcept'=>'Flagship + RB SIS'],
        ['storeconcept'=>'Intermediate'],
        ['storeconcept'=>'Intermediate + 4.0 + RB SIS + Promo Table'],
        ['storeconcept'=>'Intermediate + RB SIS'],
        ['storeconcept'=>'Intermediate + RB SIS + 4.0'],
        ['storeconcept'=>'Intermediate + RB SIS + Promo Table'],
        ['storeconcept'=>'SGH-NXT + RB SIS'],
        ['storeconcept'=>'SIS 2.0'],
        ['storeconcept'=>'SIS 6000'],
        ['storeconcept'=>'SIS 6000 + RB SIS'],
        ]);
    }
}