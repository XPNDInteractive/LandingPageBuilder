<?php

use Illuminate\Database\Seeder;
use App\Package;
use App\PackageField;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $package = new Package();
        $package->name = "Free Trail";
        $package->price = "0.00";
        $package->save();

        $pf = new PackageField();
        $pf->field = "14 days with all apps";
        $pf->package_id = $package->id;
        $pf->save();

        $pf = new PackageField();
        $pf->field = "1 user";
        $pf->package_id = $package->id;
        $pf->save();

        $pf = new PackageField();
        $pf->field = "1 company";
        $pf->package_id = $package->id;
        $pf->save();

        $package = new Package();
        $package->name = "Small Business";
        $package->price = "499.00";
        $package->save();

        $pf = new PackageField();
        $pf->field = "1 Company";
        $pf->package_id = $package->id;
        $pf->save();

        $pf = new PackageField();
        $pf->field = "10 users";
        $pf->package_id = $package->id;
        $pf->save();

        $pf = new PackageField();
        $pf->field = "10 Apps";
        $pf->package_id = $package->id;
        $pf->save();

        $pf = new PackageField();
        $pf->field = "3 Hours Support";
        $pf->package_id = $package->id;
        $pf->save();

        $package = new Package();
        $package->name = "Medium/Large Business";
        $package->price = "999.00";
        $package->save();

        $pf = new PackageField();
        $pf->field = "3 Company";
        $pf->package_id = $package->id;
        $pf->save();

        $pf = new PackageField();
        $pf->field = "20 users";
        $pf->package_id = $package->id;
        $pf->save();

        $pf = new PackageField();
        $pf->field = "Unlimted Apps";
        $pf->package_id = $package->id;
        $pf->save();

        $pf = new PackageField();
        $pf->field = "10 Hours Support";
        $pf->package_id = $package->id;
        $pf->save();

        $package = new Package();
        $package->name = "Medium/Large Business";
        $package->price = "999.00";
        $package->save();

        $pf = new PackageField();
        $pf->field = "3 Company";
        $pf->package_id = $package->id;
        $pf->save();

        $pf = new PackageField();
        $pf->field = "Unlimted users";
        $pf->package_id = $package->id;
        $pf->save();

        $pf = new PackageField();
        $pf->field = "Unlimted Apps";
        $pf->package_id = $package->id;
        $pf->save();

        $pf = new PackageField();
        $pf->field = "Unlimted Hours Support";
        $pf->package_id = $package->id;
        $pf->save();
    }
}
