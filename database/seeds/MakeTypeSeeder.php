<?php

use Illuminate\Database\Seeder;
use App\MakeType;

class MakeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = json_decode(file_get_contents('https://vpic.nhtsa.dot.gov/api/vehicles/getallmakes?format=json'));
      
        foreach($contents->Results as $make){
            $types = json_decode(file_get_contents("https://vpic.nhtsa.dot.gov/api/vehicles/GetVehicleTypesForMakeId/".$make->Make_ID."?format=json"));
            foreach($types->Results as $type){
                MakeType::firstOrCreate(['name' => $type->VehicleTypeName]);
            }
        }
    }
}
