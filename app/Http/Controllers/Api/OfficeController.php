<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Services\ReturnAPI;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = new ReturnAPI();
    }

    public function getByUUID($uuid)
    {
        $office = Office::where('uuid', $uuid)->first();
        if (is_null($office)) {
            return $this->api->code(404)->message('Not Found')->return();
        } else {
            $returnData = [
                'UUID' => (integer) $office->uuid,
                'REGION' => [
                    'UUID' => (integer) $office->region->uuid,
                    'NAME' => $office->region->name,
                    'AREA' => $office->region->region,
                    'AREA_ALIAS' => $office->region->region_alias,
                    'DOMAIN' => $office->region->domain
                ],
                'NAME' => $office->name,
                'NAME_LONG' => $office->name_long
            ];
            return $this->api->return([$returnData]);
        }
    }

    public function getByName($name)
    {
        $searchData = Office::where('name', 'like', '%'.$name.'%')->get();
        if (count($searchData) < 1) {
            return $this->api->code(404)->message('Not Found')->return();
        } else {
            $returnData = [];
            foreach ($searchData as $key => $searchDatum) {
                array_push($returnData, [
                    'UUID' => (integer) $searchDatum->uuid,
                    'REGION' => [
                        'UUID' => (integer) $searchDatum->region->uuid,
                        'NAME' => $searchDatum->region->name,
                        'AREA' => $searchDatum->region->region,
                        'AREA_ALIAS' => $searchDatum->region->region_alias,
                        'DOMAIN' => $searchDatum->region->domain
                    ],
                    'NAME' => $searchDatum->name,
                    'NAME_LONG' => $searchDatum->name_long
                ]);
            }
            return $this->api->return($returnData);
        }
    }
}
