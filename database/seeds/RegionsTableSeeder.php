<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            ['uuid' => '7010000', 'name' => '서울특별시교육청', 'region' => '서울특별시', 'region_alias' => '서울', 'domain' => 'sen'],
            ['uuid' => '7310000', 'name' => '인천광역시교육청', 'region' => '인천광역시', 'region_alias' => '인천', 'domain' => 'ice'],
            ['uuid' => '7150000', 'name' => '부산광역시교육청', 'region' => '부산광역시', 'region_alias' => '부산', 'domain' => 'pen'],
            ['uuid' => '7380000', 'name' => '광주광역시교육청', 'region' => '광주광역시', 'region_alias' => '광주', 'domain' => 'gen'],
            ['uuid' => '7430000', 'name' => '대전광역시교육청', 'region' => '대전광역시', 'region_alias' => '대전', 'domain' => 'dje'],
            ['uuid' => '7240000', 'name' => '대구광역시교육청', 'region' => '대구광역시', 'region_alias' => '대구', 'domain' => 'dge'],
            ['uuid' => '9300000', 'name' => '세종특별자치시교육청', 'region' => '세종특별자치시', 'region_alias' => '세종', 'domain' => 'sje'],
            ['uuid' => '7480000', 'name' => '울산광역시교육청', 'region' => '울산광역시', 'region_alias' => '울산', 'domain' => 'use'],
            ['uuid' => '7530000', 'name' => '경기도교육청', 'region' => '경기도', 'region_alias' => '경기', 'domain' => 'goe'],
            ['uuid' => '7800000', 'name' => '강원도교육청', 'region' => '강원도', 'region_alias' => '강원', 'domain' => 'kwe'],
            ['uuid' => '8000000', 'name' => '충청북도교육청', 'region' => '충청북도', 'region_alias' => '충북', 'domain' => 'cbe'],
            ['uuid' => '8140000', 'name' => '충청남도교육청', 'region' => '충청남도', 'region_alias' => '충남', 'domain' => 'cne'],
            ['uuid' => '8750000', 'name' => '경상북도교육청', 'region' => '경상북도', 'region_alias' => '경북', 'domain' => 'gbe'],
            ['uuid' => '9010000', 'name' => '경상남도교육청', 'region' => '경상남도', 'region_alias' => '경남', 'domain' => 'gne'],
            ['uuid' => '8320000', 'name' => '전라북도교육청', 'region' => '전라북도', 'region_alias' => '전북', 'domain' => 'jbe'],
            ['uuid' => '8490000', 'name' => '전라남도교육청', 'region' => '전라남도', 'region_alias' => '전남', 'domain' => 'jne'],
            ['uuid' => '9290000', 'name' => '제주특별자치도교육청', 'region' => '제주특별자치도', 'region_alias' => '제주', 'domain' => 'jje'],
        ];

        DB::table('regions')->insert($regions);
    }
}
