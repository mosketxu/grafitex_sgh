<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignPromediosView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement( 
            "CREATE VIEW v_campaign_promedios 
                as select 
                    campaign_id,
                    zona,
                    campaign_elementos.store_id as store_id,
                    SUM(unitxprop * precio) as tot
                from campaign_elementos 
                join campaign_tiendas
                on campaign_elementos.tienda_id=campaign_tiendas.id
                group by 
                    campaign_id, 
                    store_id,
                    zona
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
        DB::statement("DROP VIEW v_campaign_promedios");
    }
}
