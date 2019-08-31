<?php
namespace App\Services;

class MealParser {
    const REQUEST_URI = 'sts_sci_md01_001.ws';
    private $parser;

    public function __construct()
    {
        $this->parser = new ParseNEIS();
    }

    public function getMeal($school, $region, $date, $dayOfWeek)
    {
        $meal = [
            'BREAKFAST' => $this->getRawData($school, $region, $date, $dayOfWeek, 1),
            'LUNCH' => $this->getRawData($school, $region, $date, $dayOfWeek, 2),
            'DINNER' => $this->getRawData($school, $region, $date, $dayOfWeek, 3),
        ];
        return $meal;
    }

    private function getRawData($school, $region, $date, $dayOfWeek, $mealType)
    {
        $records = $this->parser->request($region, self::REQUEST_URI, [
            'insttNm' => $school['NAME'],
            'schMmealScCode' => (string) $mealType,
            'schYmd' => $date,
            'schulCode' => $school['NEIS_CODE'],
            'schulCrseScCode' => (string) (integer) $this->parser->getCourse($school['DETAIL']['COURSE_TYPE']),
            'schulKndScCode' => $this->parser->getCourse($school['DETAIL']['COURSE_TYPE']),
        ]);

        if (count($records->resultSVO->weekDietList) < 3 || $records->resultSVO->weekDietList[2]->{$dayOfWeek} == ' ') {
            return null;
        }

        $meal = $records->resultSVO->weekDietList[2]->{$dayOfWeek};

        $mealList = explode('<br />', $meal);

        unset($mealList[count($mealList)-1]);

        return $mealList;
    }
}
