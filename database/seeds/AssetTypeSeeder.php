<?php

use Illuminate\Database\Seeder;
use App\AssetType;
use App\AssetAspect;

class AssetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $at = new AssetType();
        $at->name = 'Interior';
        $at->save();

        $at = new AssetType();
        $at->name = 'Exterior';
        $at->save();

        $at = new AssetType();
        $at->name = 'Splash';
        $at->save();

        $at = new AssetType();
        $at->name = 'Multimedia';
        $at->save();



        $at = new AssetAspect();
        $at->name = 'front';
        $at->save();

        $at = new AssetAspect();
        $at->name = 'left 3/4 front';
        $at->save();

        $at = new AssetAspect();
        $at->name = 'right 3/4 front';
        $at->save();

        $at = new AssetAspect();
        $at->name = 'left 3/4 rear';
        $at->save();

        $at = new AssetAspect();
        $at->name = 'right 3/4 rear';
        $at->save();

        $at = new AssetAspect();
        $at->name = 'rear';
        $at->save();

        $at = new AssetAspect();
        $at->name = 'left side';
        $at->save();

        $at = new AssetAspect();
        $at->name = 'right side';
        $at->save();
        
    }
}
