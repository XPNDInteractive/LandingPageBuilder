<?php

use Illuminate\Database\Seeder;
use App\Manufacturer;
use App\MakeType;
use App\Make;
use App\Model as CarModel;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = json_decode(file_get_contents('https://vpic.nhtsa.dot.gov/api/vehicles/getallmanufacturers?format=json'));
      
        foreach($contents->Results as $man){
          
            $m = new Manufacturer();
            $m->country = $man->Country;
            $m->name = $man->Mfr_Name;
            $m->save();

            if(count($man->VehicleTypes) > 0){
                foreach($man->VehicleTypes as $type){
                    MakeType::firstOrCreate(['name' => $type->Name]);
                }
            }


            $makes = json_decode(file_get_contents('https://vpic.nhtsa.dot.gov/api/vehicles/GetMakeForManufacturer/'.$man->Mfr_ID.'?format=json'));

            foreach($makes->Results as $make){
                $exists = Make::where('name' , $make->Make_Name)->first();

                if(is_null($exists)){
                    $maker = new Make();
                    $maker->name = $make->Make_Name;
                    $maker->api_make_id = $make->Make_ID;
                    $maker->save();
                    $maker->manufactures()->attach($m);
                }

                else{
                    $exists->manufactures()->attach($m);
                }
               
            }
        }
    }
}
