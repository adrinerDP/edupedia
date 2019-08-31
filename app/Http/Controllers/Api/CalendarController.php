<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Services\CalendarParser;
use App\Services\InfoParser;
use App\Services\ReturnAPI;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    private $api, $parser, $calendar;

    public function __construct()
    {
        $this->api = new ReturnAPI();
        $this->parser = new InfoParser();
        $this->calendar = new CalendarParser();
    }

    public function getCalendar(Request $request)
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
        $date = Carbon::create($request->date);

        $returnData = [
            'SCHOOL' => $school['NAME'],
            'NEIS_CODE' => $school['NEIS_CODE'],
            'DATE' => $date->format('Y.m.d'),
            'CALENDAR' => $this->calendar->getCalendar($school, $region, $date)
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
        return abort(404);
    }

    private function getRegionCode($schoolName)
    {
        $school = School::where('name', $schoolName)->first();
        return $school->region->domain;
    }
}
