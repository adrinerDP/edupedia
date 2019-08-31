@extends('layout')

@section('title', '학교 검색 API')

@section('resource')
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.10/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.10/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@endsection

@section('content')
    <div class="container api_docs">
        <div class="row">
            @include('pages.api_docs.sidebar')
            <div class="col-md-9">
                @include('components.page-header')
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="badge badge-primary">GET</span> school/<i class="text-muted">{KEYWORD}</i>
                    </div>
                    <div class="card-body">
                        기관명을 이용한 검색 결과를 반환합니다.
                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Request</h6>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="font-weight-bold">KEYWORD</span> - 기관명</li>
                        </ul>

                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Response <span class="badge badge-dark">JSON</span></h6>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="font-weight-bold">NEIS_CODE</span> - 기관 NEIS 고유 코드</li>
                            <li class="list-group-item"><span class="font-weight-bold">NAME</span> - 기관명</li>
                            <li class="list-group-item"><span class="font-weight-bold">REGION</span> - 소속 교육청 기관명</li>
                            <li class="list-group-item"><span class="font-weight-bold">OFFICE</span> - 소속 교육지원청 기관명</li>
                            <li class="list-group-item">
                                <span class="font-weight-bold">COURSE_TYPE</span> - 학교급
                                <small class="text-muted">(초등학교, 중학교, 고등학교)</small>
                            </li>
                            <li class="list-group-item">
                                <span class="font-weight-bold">OPERATION_TYPE</span> - 운영형태
                                <small class="text-muted">(국립, 공립, 사립)</small>
                            </li>
                            <li class="list-group-item">
                                <span class="font-weight-bold">FOUND_TYPE</span> - 설립형태
                                <small class="text-muted">(단설, 병설, 부속)</small>
                            </li>
                            <li class="list-group-item"><span class="font-weight-bold">FOUND_AT</span> - 설립일자</li>
                            <li class="list-group-item"><span class="font-weight-bold">AREA</span> - 지역 2글자</li>
                            <li class="list-group-item"><span class="font-weight-bold">ZIP_CODE_OLD</span> - 구 우편주소</li>
                            <li class="list-group-item"><span class="font-weight-bold">ZIP_CODE_NEW</span> - 신 우편주소</li>
                            <li class="list-group-item"><span class="font-weight-bold">ADDRESS_OLD</span> - 구 지번주소</li>
                            <li class="list-group-item"><span class="font-weight-bold">ADDRESS_NEW</span> - 신 도로명 주소</li>
                            <li class="list-group-item"><span class="font-weight-bold">LATITUDE</span> - 위도</li>
                            <li class="list-group-item"><span class="font-weight-bold">LONGITUDE</span> - 경도</li>
                            <li class="list-group-item"><span class="font-weight-bold">WEBSITE</span> - 기관 홈페이지</li>
                            <li class="list-group-item"><span class="font-weight-bold">TEL</span> - 대표 전화번호</li>
                            <li class="list-group-item"><span class="font-weight-bold">FAX</span> - 대표 팩스번호</li>
                            <li class="list-group-item"><span class="font-weight-bold">STUDENT</span> - 학생 수</li>
                            <li class="list-group-item"><span class="font-weight-bold">TEACHER</span> - 교직원 수</li>
                        </ul>

                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Example Request</h6>
                        <span class="d-block mb-2">{{ route('api.school.getByName', '방이') }}</span>
                        <pre><code class="json">{
  "status": {
    "code": 200,
    "message": "Successful",
    "size": 2
  },
  "body": [
    {
      "NEIS_CODE": "B100000921",
      "NAME": "서울방이초등학교",
      "REGION": "서울특별시교육청",
      "OFFICE": "강동송파교육지원청",
      "DETAIL": {
        "COURSE_TYPE": "초등학교",
        "OPERATION_TYPE": "공립",
        "FOUND_TYPE": "단설",
        "FOUND_AT": "1981-09-09"
      },
      "LOCATION": {
        "AREA": "서울",
        "ZIP_CODE_OLD": "05636",
        "ZIP_CODE_NEW": "138833",
        "ADDRESS_OLD": "서울특별시 송파구 방이동 167번지 서울방이초등학교 ",
        "ADDRESS_NEW": "서울특별시 송파구 위례성대로10길 4",
        "LATITUDE": "37.513554",
        "LONGITUDE": "127.120940"
      },
      "CONTACT": {
        "WEBSITE": "http://www.bangi.es.kr",
        "TEL": "02-420-8477",
        "FAX": "02-420-8479"
      },
      "STUDENT": {
        "TOTAL": "608",
        "MALE": "321",
        "FEMALE": "287"
      },
      "TEACHER": {
        "TOTAL": "47",
        "MALE": "8",
        "FEMALE": "39"
      }
    },
    {
      "NEIS_CODE": "B100000867",
      "NAME": "방이중학교",
      "REGION": "서울특별시교육청",
      "OFFICE": "강동송파교육지원청",
      "DETAIL": {
        "COURSE_TYPE": "중학교",
        "OPERATION_TYPE": "공립",
        "FOUND_TYPE": "단설",
        "FOUND_AT": "1985-04-12"
      },
      "LOCATION": {
        "AREA": "서울",
        "ZIP_CODE_OLD": "05546",
        "ZIP_CODE_NEW": "138828",
        "ADDRESS_OLD": "서울특별시 송파구 방이동 53번지",
        "ADDRESS_NEW": "서울특별시 송파구 오금로11길 64",
        "LATITUDE": "37.5150094047568",
        "LONGITUDE": "127.113243457123"
      },
      "CONTACT": {
        "WEBSITE": "http://www.bangi.ms.kr",
        "TEL": "02-2152-7111",
        "FAX": "02-2152-7106"
      },
      "STUDENT": {
        "TOTAL": "409",
        "MALE": "250",
        "FEMALE": "159"
      },
      "TEACHER": {
        "TOTAL": "47",
        "MALE": "11",
        "FEMALE": "36"
      }
    }
  ]
}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
