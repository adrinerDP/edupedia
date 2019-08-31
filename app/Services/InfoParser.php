<?php
namespace App\Services;

use App\Models\School;
use GuzzleHttp\Client;

class InfoParser {
    const BASE_URI = 'https://www.schoolinfo.go.kr/ei/ss/';
    const REQUEST_URI = 'Pneiss_f01_l0.do';
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::BASE_URI,
        ]);
    }

    public function search($schoolName)
    {
        $records = $this->getKERIS($schoolName);
        $details = $this->getDB($schoolName);

        $result = [];

        foreach ($records as $key => $record) {
            $type = $this->getCourse($record->SCHUL_CRSE_SC_CODE);

            array_push($result, [
                'NEIS_CODE'          => $record->SCHUL_CODE,          // 교육행정정보망 코드
                'NAME'               => $record->SCHUL_NM,            // 학교명
                'REGION'             => $details[$key]->region->name, // 시도교육청   [DB]
                'OFFICE'             => $details[$key]->office->name, // 지역교육청   [DB]
                'DETAIL' => [
                    'COURSE_TYPE'    => $type,                        // 학교급
                    'OPERATION_TYPE' => $record->FOND_SC_NM,          // 운영형태
                    'FOUND_TYPE'     => $record->SCHUL_FOND_TYP_NM,   // 설립형태
                    'FOUND_AT'       => $details[$key]->found_at      // 설립일자
                ],
                'LOCATION' => [
                    'AREA'           => $record->LCTN_NM,             // 지역
                    'ZIP_CODE_OLD'   => $details[$key]->zip_code,     // 구 우편번호  [DB]
                    'ZIP_CODE_NEW'   => $record->ZIP_CODE,            // 신 우편번호
                    'ADDRESS_OLD'    => $details[$key]->address,      // 구 지번주소  [DB]
                    'ADDRESS_NEW'    => $record->ADDRESS,             // 신 도로명주소
                    'LATITUDE'       => $details[$key]->latitude,     // 위도       [DB]
                    'LONGITUDE'      => $details[$key]->longitude     // 경도       [DB]
                ],
                'CONTACT' => [
                    'WEBSITE'        => $record->HMPG_ADRES,          // 홈페이지 주소
                    'TEL'            => $record->USER_TELNO,          // 전화번호
                    'FAX'            => $record->PERC_FAXNO,          // 팩스번호
                ],
                'STUDENT' => [
                    'TOTAL'          => $record->SUM,                 // 총 학생
                    'MALE'           => $record->BOYST_FGR,           // 남학생
                    'FEMALE'         => $record->FES_FGR,             // 여학생
                ],
                'TEACHER' => [
                    'TOTAL'          => $record->TCHER_CNT,           // 총 교직원
                    'MALE'           => $record->M_TCHER_CNT,         // 남교직원
                    'FEMALE'         => $record->F_TCHER_CNT,         // 여교직원
                ]
            ]);
        }

        return $result;
    }

    private function getKERIS($name)
    {
        $response = $this->client->request('POST', self::REQUEST_URI, [
            'headers' => ['Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'],
            'form_params' => ['SEARCH_SCHUL_NM' => $name,'callbackMode' => 'json']
        ]);

        $records = json_decode($response->getBody()->getContents());

        if ($records == null) {
            return abort(404);
        } else {
            return $records;
        }
    }

    private function getDB($name)
    {
        return School::where('name', 'like', '%'.$name.'%')->get();
    }

    private function getCourse($code)
    {
        switch($code) {
            case '02':
                return '초등학교';
                break;
            case '03':
                return '중학교';
                break;
            case '04':
                return '고등학교';
                break;
            default:
                return null;
        }
    }
}
