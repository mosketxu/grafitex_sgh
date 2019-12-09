<?php

use App\TarifaFamilia;
use Illuminate\Database\Seeder;

class TarifaFamiliasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TarifaFamilia::actualizaFamilia('Backlite',2);
        TarifaFamilia::actualizaFamilia('Corporate',3);
        TarifaFamilia::actualizaFamilia('Couch',4);
        TarifaFamilia::actualizaFamilia('Crist',5);
        TarifaFamilia::actualizaFamilia('Foam',6);
        TarifaFamilia::actualizaFamilia('Glasspa',7);
        TarifaFamilia::actualizaFamilia('Imán',8);
        TarifaFamilia::actualizaFamilia('Lona',9);
        TarifaFamilia::actualizaFamilia('Metacrilato',10);
        TarifaFamilia::actualizaFamilia('Papel',11);
        TarifaFamilia::actualizaFamilia('Pet',12);
        TarifaFamilia::actualizaFamilia('PVC',13);
        TarifaFamilia::actualizaFamilia('Tela',14);
        TarifaFamilia::actualizaFamilia('Vinilo',15);
    }
}
