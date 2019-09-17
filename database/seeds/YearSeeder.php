<?php

use Illuminate\Database\Seeder;
use App\Year;
use App\Make;
use App\Model;
use App\BodyType;
use App\MakeYear;
use App\User;
use App\Asset;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new User();
        $user->name = 'jgetner';
        $user->email = 'jgetner@gmail.com';
        $user->password = bcrypt('eclipse1');
        $user->api_token = \uniqid(\uniqid(), true);
        $user->save();

        $gyear = null;
        $gmake = null;

        echo "\n\n---------- GETTING ALL YEARS... \n";
        $years = json_decode(file_get_contents('http://321110:0dfb29d1c63f49fe@media.chromedata.com/MediaGallery/service/US.json'), true);
        foreach($years['yearLink'] as $year){
            $y = $year["$"];

            $ym = new Year();
            $ym->year = $y;
            $ym->save();
            echo "SAVED YEAR: " . $y . "\n";

           $gyear = $y;
        }

        echo "---------- SAVED ALL YEARS! \n \n";

       
        foreach(Year::all() as $year){
            echo "---------- GETTING ALL MAKES FOR YEAR $year->year... \n";
            $makes = json_decode(file_get_contents('http://321110:0dfb29d1c63f49fe@media.chromedata.com/MediaGallery/service/US/'.$year->year.'.json'), true);
            
            foreach($makes['divisionLink'] as $maker){
                $make = $maker['$'];

                $m = Make::where('name', $make)->first();

                if(is_null($m)){
                    $m = new Make();
                    $m->name = $make;
                    $m->save();
                    echo "SAVED MAKE: " . $make . "\n";
                }

                $m->years()->attach($year);

                
                echo "---------- GETTING ALL MODEL FOR MAKE $m->name AND YEAR $year->year... \n";
                $response = @file_get_contents('http://321110:0dfb29d1c63f49fe@media.chromedata.com/MediaGallery/service/US/'.$year->year.'/'.$make.'.json');
                
                if($response !== false){
                    $models = json_decode($response, true);
                 
                    if(isset($models['modelLink'] )){
                        foreach($models['modelLink'] as $model){

                            $modelName = null;

                            if(isset($model['$'])){
                               $modelName = $model['$'];
                            }

                            else{
                                $modelName = $models['modelLink']['$'];
                            }

                            $mo = Model::where('name', $modelName)->first();
    
                            if(is_null($mo)){
                                $mo = new Model();
                                $mo->make_years_id = MakeYear::where('make_id', $m->id)->where('year_id', $year->id)->first()->id;
                                $mo->name = $modelName;
                                $mo->save();
                                echo "SAVED MODEL: " . $mo->name . " FOR MAKE: $m->name \n";
                               
                            }

                           
                            
                            echo "---------- GETTING ALL BODYTYPES FOR MODEL $mo->name AND MAKE $m->name AND YEAR $year->year... \n";
                            $response = @file_get_contents('http://321110:0dfb29d1c63f49fe@media.chromedata.com/MediaGallery/service/US/'.$year->year.'/'.$m->name.'/'.$mo->name.'.json');

                            if($response !== false){
                                $bodyTypes = json_decode($response, true);

                                if(isset($bodyTypes["bodyTypeLink"])){
                                    foreach($bodyTypes["bodyTypeLink"] as $bodyType){
                                        $bodyTypeName = null;

                                        if(isset($bodyType['$'])){
                                            $bodyTypeName = $bodyType['$'];
                                        }

                                        else{
                                            $bodyTypeName = $bodyTypes["bodyTypeLink"]['$'];
                                        }

                                    
                                        $bt = BodyType::where('name', $bodyTypeName)->where('model_id', $mo->id)->first();

                                       
                                        if(is_null($bt)){
                                            $bt = new BodyType();
                                            $bt->model_id = $mo->id;
                                            $bt->name = $bodyTypeName;
                                            $bt->save();
                                            echo "SAVED BODY TYPE: " . $bt->name . " FOR MODEL: $mo->name \n";
                                        }

                                        echo "---------- GETTING ALL BODYTYPES FOR MODEL $mo->name AND MAKE $m->name AND YEAR $year->year... \n";
                                        $response = @file_get_contents('http://321110:0dfb29d1c63f49fe@media.chromedata.com/MediaGallery/service/US/'.$year->year.'/'.$m->name.'/'.$mo->name.'/'.$bodyTypeName.'.json');
                                    
                                        if($response !== false){
                                            $assets = json_decode($response, true);
                                            
                                            if(isset($assets['view'])){
                                                foreach($assets['view'] as $asset){
                                                    
                                                    if(isset($asset['@shotCode'])){
                                                        $i = file_get_contents($asset['@href']);

                                                        $imgName = \uniqid();

                                                        if($i !== false){
                                                            if(file_put_contents(storage_path() . '/app/public/assets/' . $imgName .'.png', $i) !== false){
                                                                $img = new Asset();
                                                                $img->asset_type_id = 1;
                                                                $img->body_type_id = $bt->id;
                                                                $img->profile = $asset['@shotCode'];
                                                                $img->height = $asset['@height'];
                                                                $img->width = $asset['@width'];
                                                                $img->src = storage_path() . '/app/public/assets/' . $imgName .'.png';
                                                                $img->save();
                                                            }

                                                        
                                                        }
    
                                                     
                                                       
                                                    }
                                                  
                                                }
                                            }
                                        }

                                        
                                    }
                                }
                                
                            }
                            
                        }
                    }

                    else{
                        die('There is an unkown model for make:' . $m->name);
                    }
                   
                }
                
            }
        }

    

    
            
      
        
    }
}
