<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Zone;
use DB;

class ZonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
            DB::table('zones')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $zones_all = [];

        $zones = Zone::create([
            'name'          => 'Zona 1',
        ]);

        $zones_all[] = $zones->id;

        $zones = Zone::create([
            'name'          => 'Zona 2',
        ]);

        $zones_all[] = $zones->id;

        $zones = Zone::create([
            'name'          => 'Zona 3',
        ]);

        $zones_all[] = $zones->id;

        $zones = Zone::create([
            'name'          => 'Zona 4',
        ]);

        $zones_all[] = $zones->id;

        $zones = Zone::create([
            'name'          => 'Zona 5',
        ]);

        $zones_all[] = $zones->id;

        $zones = Zone::create([
            'name'          => 'Zona 6',
        ]);

        $zones_all[] = $zones->id;

        $zones = Zone::create([
            'name'          => 'Zona 7',
        ]);

        $zones_all[] = $zones->id;

        $zones = Zone::create([
            'name'          => 'Zona 8',
        ]);

        $zones_all[] = $zones->id;

        $zones = Zone::create([
            'name'          => 'Zona 9',
        ]);

        $zones_all[] = $zones->id;

        $zones = Zone::create([
            'name'          => 'Zona 10',
        ]);

        $zones_all[] = $zones->id;

        $zones = Zone::create([
            'name'          => 'Zona 11',
        ]);

        $zones_all[] = $zones->id;
    }
}
