<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\FacebookMealPoster;
use App\Services\CalendarParser;
use App\Services\InfoParser;
use App\Services\MealParser;
use Carbon\Carbon;

class FacebookController extends Controller
{
    private $infoParser, $mealAPI, $calendarAPI, $now, $user, $school;

    public function __construct()
    {
        $this->infoParser = new InfoParser();
        $this->mealAPI = new MealParser();
        $this->calendarAPI = new CalendarParser();

        $this->now = Carbon::now();
        $this->user = User::find(1);

        $this->school = $this->infoParser->search('고려고등학교');
        $this->school = $this->school[0];
    }

    public function post()
    {
        $meal = $this->mealAPI->getMeal($this->school, 'gen', $this->now->format('Y.m.d'), $this->getDayOfWeek($this->now->dayOfWeek));
        $calendar = $this->calendarAPI->getCalendar($this->school, 'gen', $this->now);
        $calendar = $this->getStringCalendar($calendar);

        $message = sprintf("%s 고려고등학교 급식 정보입니다.\n\n", $this->now->format('Y년 m월 d일'));

        $returnMeal = array_filter([
            '조식' => $this->getStringMeal($meal, 'BREAKFAST'),
            '중식' => $this->getStringMeal($meal, 'LUNCH'),
            '석식' => $this->getStringMeal($meal, 'DINNER'),
        ]);

        foreach ($returnMeal as $key => $value) {
            $message .= sprintf("%s: %s\n\n", $key, $value);
        }

        if (!is_null($calendar)) {
            $message .= "[학사 일정]\n";
            $message .= $calendar."\n";
        }

        $message .= 'Powered by EDUPEDIA API';

        $this->user->notify(new FacebookMealPoster($message));

        return $message;
    }

    private function getStringMeal($meal, $type)
    {
        $returnMeal = '';
        if (!is_null($meal[$type])) {
            foreach ($meal[$type] as $item) {
                $returnMeal .= preg_replace("/(^[0-9]*|[0-9]+$)/", '', str_replace('.', '', $item)) . ', ';
            }
            return substr($returnMeal, 0, -2);
        } else {
            unset($meal[$type]);
        }
    }

    private function getStringCalendar($calendar)
    {
        $returnCalendar = '';
        if (!is_null($calendar)) {
            foreach ($calendar as $item) {
                $returnCalendar .= $item."\n";
            }
            return $returnCalendar;
        } else {
            return null;
        }
    }

    private function getDayOfWeek($dayOfWeek)
    {
        switch ($dayOfWeek) {
            case 1:
                $dayOfWeek = 'mon';
                break;
            case 2:
                $dayOfWeek = 'tue';
                break;
            case 3:
                $dayOfWeek = 'wed';
                break;
            case 4:
                $dayOfWeek = 'the';
                break;
            case 5:
                $dayOfWeek = 'fri';
                break;
            case 6:
                $dayOfWeek = 'sat';
                break;
            case 0:
                $dayOfWeek = 'sun';
                break;
            default:
                $dayOfWeek = 'mon';
        }
        return $dayOfWeek;
    }
}
