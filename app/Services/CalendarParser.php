<?php
namespace App\Services;

use Carbon\Carbon;


class CalendarParser {
    const REQUEST_URI = "sts_sci_sf01_001.ws";
    private $parser;

    public function __construct()
    {
        $this->parser = new ParseNEIS();
    }

    public function getCalendar($school, $region, $date)
    {
        $calendar = $this->getRawData($school, $region, $date);
        return $calendar;
    }

    private function getRawData($school, $region, Carbon $date)
    {
        $records = $this->parser->request($region, self::REQUEST_URI, [
            'ay' => (string) $date->year,
            'mm' => (string) $date->format('m'),
            'schulCode' => $school['NEIS_CODE'],
            'schulCrseScCode' => (string) (integer) $this->parser->getCourse($school['DETAIL']['COURSE_TYPE']),
            'schulKndScCode' => $this->parser->getCourse($school['DETAIL']['COURSE_TYPE']),
        ]);

        $weekKey = $this->getWeekOfMonth($date)-1;
        $dayKey = sprintf('event%s', $date->dayOfWeek+1);
        $events = explode('|', $records->resultSVO->selectMonth[$weekKey]->{$dayKey});
        $eventList = [];

        foreach ($events as $event) {
            $event = explode(':', $event);
            array_push($eventList, $event[2]);
        }

        return $eventList;
    }

    private function getWeekOfMonth(Carbon $date)
    {
        $timestamp = $date->getTimestamp();
        $w = date('w', mktime(0,0,0, date('n',$timestamp), 1, date('Y',$timestamp)));
        return (integer) ceil(($w + date('j',$timestamp)) / 7);
    }
}
