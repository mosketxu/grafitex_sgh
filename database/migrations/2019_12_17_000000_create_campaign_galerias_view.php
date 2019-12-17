<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignGaleriasView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(
            "CREATE VIEW v_campaign_galerias 
                as select 
                    campaign_id,
                    mobiliario,
                    carteleria,
                    medida,
                    REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(concat(mobiliario,carteleria,medida),' ',''),'.',''),'(',''),')',''),'+',''),'/','') as elemento,
                    if(left(name,3)='ECI','ECI','') as ECI,
                    CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(concat(mobiliario,carteleria,medida),' ',''),'.',''),'(',''),')',''),'+',''),'/',''),if(left(name,3)='ECI','ECI',''),'.jpg') AS imagen
                from campaign_elementos 
                group by 
                    campaign_id, 
                    mobiliario,
                    carteleria,
                    medida,
                    REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(concat(mobiliario,carteleria,medida),' ',''),'.',''),'(',''),')',''),'+',''),'/',''),
                    if(left(name,3)='ECI','ECI',''),
                    CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(concat(mobiliario,carteleria,medida),' ',''),'.',''),'(',''),')',''),'+',''),'/',''),if(left(name,3)='ECI','ECI',''),'.jpg')
                ;"
            );
        // DB::statement(
        //     "CREATE VIEW v_campaign_galerias 
        //         as select 
        //             campaign_id,
        //             mobiliario,
        //             carteleria,
        //             medida,
        //             REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(concat(mobiliario,carteleria,medida),' ',''),'.',''),'(',''),')',''),'+','') as elemento,
        //             if(left(name,3)='ECI','ECI','') as ECI,
        //             CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(concat(mobiliario,carteleria,medida),' ',''),'.',''),'(',''),')',''),'+',''),if(left(name,3)='ECI','ECI',''),'.jpg') AS imagen
        //         from campaign_elementos 
        //         group by 
        //             campaign_id, 
        //             mobiliario,
        //             carteleria,
        //             medida,
        //             REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(concat(mobiliario,carteleria,medida),' ',''),'.',''),'(',''),')',''),'+',''),
        //             if(left(name,3)='ECI','ECI',''),
        //             CONCAT(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(concat(mobiliario,carteleria,medida),' ',''),'.',''),'(',''),')',''),'+',''),if(left(name,3)='ECI','ECI',''),'.jpg')
        //         ;"
        //     );
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_campaign_galerias");
    }
}
