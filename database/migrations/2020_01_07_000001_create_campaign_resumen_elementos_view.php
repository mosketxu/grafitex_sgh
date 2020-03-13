<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignResumenElementosView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement( 
            "CREATE VIEW v_campaign_resumen_elementos
                as select 
                    campaign_id,
                    familia,
                    precio,
                    SUM(unitxprop) as unidades,
                    SUM(unitxprop * precio) as tot
                from campaign_elementos 
                join campaign_tiendas
                on campaign_elementos.tienda_id=campaign_tiendas.id
                group by 
                    campaign_id, 
                    familia,
                    precio
                ;"
            );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW v_campaign_resumen_elementos");
    }
}
