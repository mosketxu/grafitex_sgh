<?php

use Illuminate\Database\Seeder;

class TarifaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tarifas')->delete();

        DB::table('tarifas')->insert([
            ['zona'=>' ','familia'=>'Sin identificar','tipo'=>0,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>5,'tarifa2'=>10,'tramo3'=>15,'tarifa3'=>20],
            ['zona'=>' ','familia'=>'Backlite','tipo'=>0,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>5,'tarifa2'=>10,'tramo3'=>15,'tarifa3'=>20],
            ['zona'=>' ','familia'=>'Corporate','tipo'=>0,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>5,'tarifa2'=>10,'tramo3'=>15,'tarifa3'=>20],
            ['zona'=>' ','familia'=>'Couché','tipo'=>0,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>5,'tarifa2'=>10,'tramo3'=>15,'tarifa3'=>20],
            ['zona'=>' ','familia'=>'Cristal','tipo'=>0,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>5,'tarifa2'=>10,'tramo3'=>15,'tarifa3'=>20],
            ['zona'=>' ','familia'=>'Foam','tipo'=>0,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>5,'tarifa2'=>10,'tramo3'=>15,'tarifa3'=>20],
            ['zona'=>' ','familia'=>'Glasspack','tipo'=>0,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>5,'tarifa2'=>10,'tramo3'=>15,'tarifa3'=>20],
            ['zona'=>' ','familia'=>'Imán','tipo'=>0,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>5,'tarifa2'=>10,'tramo3'=>15,'tarifa3'=>20],
            ['zona'=>' ','familia'=>'Lona','tipo'=>0,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>5,'tarifa2'=>10,'tramo3'=>15,'tarifa3'=>20],
            ['zona'=>' ','familia'=>'Metacrilato','tipo'=>0,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>5,'tarifa2'=>10,'tramo3'=>15,'tarifa3'=>20],
            ['zona'=>' ','familia'=>'Papel','tipo'=>0,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>5,'tarifa2'=>10,'tramo3'=>15,'tarifa3'=>20],
            ['zona'=>' ','familia'=>'Pet','tipo'=>0,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>5,'tarifa2'=>10,'tramo3'=>15,'tarifa3'=>20],
            ['zona'=>' ','familia'=>'PVC','tipo'=>0,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>5,'tarifa2'=>10,'tramo3'=>15,'tarifa3'=>20],
            ['zona'=>' ','familia'=>'Tela','tipo'=>0,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>5,'tarifa2'=>10,'tramo3'=>15,'tarifa3'=>20],
            ['zona'=>' ','familia'=>'Vinilo','tipo'=>0,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>5,'tarifa2'=>10,'tramo3'=>15,'tarifa3'=>20],
            ['zona'=>'ES','familia'=>'Picking','tipo'=>1,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>0,'tarifa2'=>0,'tramo3'=>0,'tarifa3'=>0],
            ['zona'=>'CN','familia'=>'Picking','tipo'=>1,'tramo1'=>1,'tarifa1'=>6,'tramo2'=>0,'tarifa2'=>0,'tramo3'=>0,'tarifa3'=>0],
            ['zona'=>'PT','familia'=>'Picking','tipo'=>1,'tramo1'=>1,'tarifa1'=>7,'tramo2'=>0,'tarifa2'=>0,'tramo3'=>0,'tarifa3'=>0],
            ['zona'=>'ES','familia'=>'Transporte','tipo'=>2,'tramo1'=>1,'tarifa1'=>5,'tramo2'=>0,'tarifa2'=>0,'tramo3'=>0,'tarifa3'=>0],
            ['zona'=>'CN','familia'=>'Transporte','tipo'=>2,'tramo1'=>1,'tarifa1'=>6,'tramo2'=>0,'tarifa2'=>0,'tramo3'=>0,'tarifa3'=>0],
            ['zona'=>'PT','familia'=>'Transporte','tipo'=>2,'tramo1'=>1,'tarifa1'=>7,'tramo2'=>0,'tarifa2'=>0,'tramo3'=>0,'tarifa3'=>0],
        ]);
    }
}
