<?php

use Illuminate\Database\Seeder;
use App\Make;
use App\User;
use App\Year;
use App\MakeYear;
use App\Model;
use App\BodyType;

class MakeSeeder extends Seeder
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



        $_2019 = new Year();
        $_2019->year = 2019;
        $_2019->save();

        $make = new Make();
        $make->name = "Chevrolet";
        $make->save();
        
        $makeYear = new MakeYear();
        $makeYear->make_id = $make->id;
        $makeYear->year_id = $_2019->id;
        $makeYear->save();

        $model = new Model();
        $model->make_years_id = $makeYear->id;
        $model->name = "Silverado 1500";
        $model->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "High Country";
        $trim->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "LTZ";
        $trim->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "LT Trail Boss";
        $trim->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "RST";
        $trim->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "LT";
        $trim->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "Custom Trail Boss";
        $trim->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "Custom";
        $trim->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "Work Truck";
        $trim->save();


          
        $_2020 = new Year();
        $_2020->year = 2020;
        $_2020->save();

        $make = Make::where('name', 'Chevrolet')->first();
     
        
        $makeYear = new MakeYear();
        $makeYear->make_id = $make->id;
        $makeYear->year_id = $_2020->id;
        $makeYear->save();

        $model = new Model();
        $model->make_years_id = $makeYear->id;
        $model->name = "Silverado 1500";
        $model->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "High Country";
        $trim->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "LTZ";
        $trim->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "LT Trail Boss";
        $trim->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "RST";
        $trim->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "LT";
        $trim->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "Custom Trail Boss";
        $trim->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "Custom";
        $trim->save();

        $trim = new BodyType();
        $trim->model_id = $model->id;
        $trim->name = "Work Truck";
        $trim->save();


    }
}
