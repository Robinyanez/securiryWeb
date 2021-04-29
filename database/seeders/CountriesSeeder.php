<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use DB;
use Http;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
            DB::table('countries')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $json = Http::get('http://www.geonames.org/servlet/geonames?&srv=163&country=EC&featureCode=ADM1&lang=en&type=json');
        $fulldata = json_decode($json,true);

        foreach ($fulldata['geonames'] as $key=>$obj) {

            Country::create(array(
                'name'          => $obj['name'],
            ));
        }

    }
}
