<?php

use Illuminate\Database\Seeder;
use App\Make;
use App\Model;
use App\Year;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $makes = Make::all();

      

       
        $from = new \DateTime('01/1/1918');
        $to = new DateTime();
        $years = [];

        for($date=clone $from; $date<$to; $date->modify('+1 year')){
            echo "-- adding new year to year table " . $date->format('Y') ;
            $y = new Year();
            $y->year = $date->format('Y');
            $y->save();
        }
        
       
        foreach($makes as $make){
            echo "-- MAKE: " . $make->name . "\n";
            foreach(Year::all() as $year){
                $requestUrl = 'https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeyear/make/'.$make->name.'/modelyear/'.$year->year.'?format=json';
                echo '--> REQUEST: ' . $requestUrl . "\n";
                $requestData = @file_get_contents($requestUrl);
                echo '<-- RESPONSE: ' . $requestData  . "\n";
                
                
                if($requestData !== false){
                    $models = json_decode($requestData);

                    if(isset($models->Results) && count($models->Results) > 0){
                        foreach($models->Results as $model){
                            var_dump($year . ' - '. $model->Model_Name);
                            $modExists = Model::where('name' , $model->Model_Name)->first();
                           
            
                            if(is_null($modExists)){
                                $mod = new Model();
                                $mod->make_id = $make->id;
                                $mod->name = $model->Model_Name;
                                $mod->save();
                                $mod->years()->attach($year);
                            }

                            else{
                                $modExists->years()->attach($year);
                            }
                        }
                    }
                }

                continue;
            }

            continue;
           
        }
    }
}
