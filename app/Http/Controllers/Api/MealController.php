<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Services\InfoParser;
use App\Services\MealParser;
use App\Services\ReturnAPI;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MealController extends Controller
{
    private $api, $parser, $meal;

    public function __construct()
    {
        $this->api = new ReturnAPI();
        $this->parser = new InfoParser();
        $this->meal = new MealParser();
    }

    public function getMeal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'school' => 'required|exists:schools,name',
            'code' => 'required',
            'date' => 'required|date_format:Y-m-d'
        ]);

        if ($validator->fails()) {
            return $this->api->code(400)->message('Bad Request')->return();
        }

        $school = $this->searchSchool($request->school, $request->code);
        $region = $this->getRegionCode($school['NAME']);
        $date = Carbon::create($request->date)->format('Y.m.d');
        $dayOfWeek = $this->getDayOfWeek(Carbon::createFromFormat('Y.m.d', $date)->dayOfWeek);

        $returnData = [
            'SCHOOL' => $school['NAME'],
            'NEIS_CODE' => $school['NEIS_CODE'],
            'DATE' => $date,
            'MEAL' => $this->meal->getMeal($school, $region, $date, $dayOfWeek)
        ];

        return $this->api->return($returnData);
    }

    private function searchSchool($school, $code)
    {
        $schools = $this->parser->search($school);

        foreach($schools as $school) {
            if ($school['NEIS_CODE'] === $code) {
                return $school;
            }
        }
        return $this->api->code(400)->message('Bad Request')->return();
    }

    private function getRegionCode($schoolName)
    {
        $school = School::where('name', $schoolName)->first();
        return $school->region->domain;
    }

    private function getDayOfWeek($dayOfWeek)
    {
        switch ($dayOfWeek) {
            case 0:
                $dayOfWeek = 'mon';
                break;
            case 1:
                $dayOfWeek = 'tue';
                break;
            case 2:
                $dayOfWeek = 'wed';
                break;
            case 3:
                $dayOfWeek = 'the';
                break;
            case 4:
                $dayOfWeek = 'fri';
                break;
            case 5:
                $dayOfWeek = 'sat';
                break;
            case 6:
                $dayOfWeek = 'sun';
                break;
            default:
                $dayOfWeek = 'mon';
        }
        return $dayOfWeek;
    }
}
