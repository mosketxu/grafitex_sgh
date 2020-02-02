<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
            // $this->call(StoresTableSeeder::class);
            // $this->call(AddressesTableSeeder::class);
            // $this->call(ElementsTableSeeder::class);
            // $this->call(CampaignsTableSeeder::class);
            // $this->call(StoreElementsTableSeeder::class);
            // $this->call(MedidaTableSeeder::class);
            // $this->call(CarteleriasTableSeeder::class);
            // $this->call(MobiliariosTableSeeder::class);
            // $this->call(UbicacionsTableSeeder::class);
            // $this->call(SegmentosTableSeeder::class);
            // $this->call(StoreconceptsTableSeeder::class);
            // $this->call(AreasTableSeeder::class);
        // $this->call(CountriesTableSeeder::class);
        // $this->call(TarifaSeeder::class);
        // $this->call(MaterialMedidasSeeder::class);
        // $this->call(TarifaFamiliasSeeder::class);
        // $this->call(PermissionsTableSeeder::class);
        // $this->call(usuariostiendas::class);
    }
}
