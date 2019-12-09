<?php

use Illuminate\Database\Seeder;


class CampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Campaign::class, 2)->create()
        ->each(function(\App\Campaign $b){
            for ($i=0; $i < 5; $i++) {
                \DB::table('campaign_stores')->insert(array(
                    'store_id'=>\App\Store::all()->random()->id,
                    'campaign_id'=>$b->id
                ));
            }
        });

        factory(\App\Campaign::class, 500)->create()
        ->each(function(\App\Campaign $b){
            factory(\App\CampaignStore::class,6)->create(['campaign_id'=>$b->id]);
        });
    }
}
