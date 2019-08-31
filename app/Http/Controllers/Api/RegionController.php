<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Services\ReturnAPI;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = new ReturnAPI();
    }

    public function getByUUID($uuid)
    {
        $region = Region::where('uuid', $uuid)->first();
        if (is_null($region)) {
            return $this->api->code(404)->message('Not Found')->return();
        } else {
            $returnData = [
                'UUID' => (integer) $region->uuid,
                'NAME' => $region->name,
                'AREA' => $region->region,
                'AREA_ALIAS' => $region->region_alias,
                'DOMAIN' => $region->domain
            ];
            return $this->api->return([$returnData]);
        }
    }

    public function getByDomain($domain)
    {
        $region = Region::where('domain', $domain)->first();
        if (is_null($region)) {
            return $this->api->code(404)->message('Not Found')->return();
        } else {
            $returnData = [
                'UUID' => $region->uuid,
                'NAME' => $region->name,
                'AREA' => $region->region,
                'AREA_ALIAS' => $region->region_alias,
                'DOMAIN' => $region->domain
            ];
            return $this->api->return([$returnData]);
        }
    }

    public function getByName($name)
    {
        $searchData = Region::where('name', 'like', '%'.$name.'%')->get();
        if (count($searchData) < 1) {
            return $this->api->code(404)->message('Not Found')->return();
        } else {
            $returnData = [];
            foreach ($searchData as $key => $searchDatum) {
                array_push($returnData, [
                    'UUID' => $searchDatum->uuid,
                    'NAME' => $searchDatum->name,
                    'AREA' => $searchDatum->region,
                    'AREA_ALIAS' => $searchDatum->region_alias,
                    'DOMAIN' => $searchDatum->domain
                ]);
            }
            return $this->api->return($returnData);
        }
    }

    public function getOffices($uuid)
    {
        $region = Region::where('uuid', $uuid)->first();
        if (is_null($region)) {
            return $this->api->code(404)->message('Not Found')->return();
        } else {
            $returnData = [];
            foreach ($region->offices as $key => $searchDatum) {
                array_push($returnData, [
                    'UUID' => $searchDatum->uuid,
                    'NAME' => $searchDatum->name,
                    'NAME_LONG' => $searchDatum->name_long,
                ]);
            }
            return $this->api->return($returnData);
        }
    }
}
