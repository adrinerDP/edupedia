<?php

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = json_decode(iconv('euc-kr', 'UTF-8', file_get_contents(base_path('resources/regions.json'))), true);
        $offices = $offices['records'];
        $result = [];
        foreach ($offices as $office) {
            $office = array_values($office);
            $region = Region::where('uuid', $office[3])->first();
            array_push($result, [
                'uuid' => $office[5],
                'region_id' => $region->id,
                'name' => $office[6],
                'name_long' => $region->region.$office[6]
            ]);
        }
        $regions = Region::all('name')->pluck('name');
        foreach ($regions as $key => $region) {
            array_push($result, [
                'uuid' => '0000000',
                'region_id' => $key+1,
                'name' => $region,
                'name_long' => $region
            ]);
            array_push($result, [
                'uuid' => '0000000',
                'region_id' => $key+1,
                'name' => $region,
                'name_long' => '교육부'
            ]);
        }

        DB::table('offices')->insert($result);
    }
}
