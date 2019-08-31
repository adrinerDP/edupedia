@extends('layout')

@section('title', '교육청 API')

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
                        <span class="badge badge-primary">GET</span> region/uuid/<i class="text-muted">{UUID}</i>
                    </div>
                    <div class="card-body">
                        기관 고유 코드를 이용한 조회 결과를 반환합니다.
                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Request</h6>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="font-weight-bold">UUID</span> - 기관 고유 코드</li>
                        </ul>

                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Response <span class="badge badge-dark">JSON</span></h6>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="font-weight-bold">UUID</span> - 기관 고유 코드</li>
                            <li class="list-group-item"><span class="font-weight-bold">NAME</span> - 기관명</li>
                            <li class="list-group-item"><span class="font-weight-bold">AREA</span> - 관할 지역명</li>
                            <li class="list-group-item"><span class="font-weight-bold">AREA_ALIAS</span> - 관할 지역명 2글자</li>
                            <li class="list-group-item"><span class="font-weight-bold">DOMAIN</span> - NEIS 고유 코드</li>
                        </ul>

                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Example Request</h6>
                        <span class="d-block mb-2">{{ route('api.region.getByUUID', 7010000) }}</span>
                        <pre><code class="json">{
  "status": {
    "code": 200,
    "message": "Successful",
    "size": 1
  },
  "body": [
    {
      "UUID": 7010000,
      "NAME": "서울특별시교육청",
      "AREA": "서울특별시",
      "AREA_ALIAS": "서울",
      "DOMAIN": "sen"
    }
  ]
}</code></pre>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <span class="badge badge-primary">GET</span> region/domain/<i class="text-muted">{CODE}</i>
                    </div>
                    <div class="card-body">
                        기관 NEIS 고유 코드를 이용한 조회 결과를 반환합니다.
                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Request</h6>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="font-weight-bold">CODE</span> - 기관 NEIS 고유 코드</li>
                        </ul>

                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Response <span class="badge badge-dark">JSON</span></h6>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="font-weight-bold">UUID</span> - 기관 고유 코드</li>
                            <li class="list-group-item"><span class="font-weight-bold">NAME</span> - 기관명</li>
                            <li class="list-group-item"><span class="font-weight-bold">AREA</span> - 관할 지역명</li>
                            <li class="list-group-item"><span class="font-weight-bold">AREA_ALIAS</span> - 관할 지역명 2글자</li>
                            <li class="list-group-item"><span class="font-weight-bold">DOMAIN</span> - NEIS 고유 코드</li>
                        </ul>

                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Example Request</h6>
                        <span class="d-block mb-2">{{ route('api.region.getByDomain', 'gen') }}</span>
                        <pre><code class="json">{
  "status": {
    "code": 200,
    "message": "Successful",
    "size": 1
  },
  "body": [
    {
      "UUID": "7380000",
      "NAME": "광주광역시교육청",
      "AREA": "광주광역시",
      "AREA_ALIAS": "광주",
      "DOMAIN": "gen"
    }
  ]
}</code></pre>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <span class="badge badge-primary">GET</span> region/name/<i class="text-muted">{KEYWORD}</i>
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
                            <li class="list-group-item"><span class="font-weight-bold">UUID</span> - 기관 고유 코드</li>
                            <li class="list-group-item"><span class="font-weight-bold">NAME</span> - 기관명</li>
                            <li class="list-group-item"><span class="font-weight-bold">AREA</span> - 관할 지역명</li>
                            <li class="list-group-item"><span class="font-weight-bold">AREA_ALIAS</span> - 관할 지역명 2글자</li>
                            <li class="list-group-item"><span class="font-weight-bold">DOMAIN</span> - NEIS 고유 코드</li>
                        </ul>

                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Example Request</h6>
                        <span class="d-block mb-2">{{ route('api.region.getByName', '광역시') }}</span>
                        <pre><code class="json">{
  "status": {
    "code": 200,
    "message": "Successful",
    "size": 6
  },
  "body": [
    {
      "UUID": "7310000",
      "NAME": "인천광역시교육청",
      "AREA": "인천광역시",
      "AREA_ALIAS": "인천",
      "DOMAIN": "ice"
    },
    {
      "UUID": "7150000",
      "NAME": "부산광역시교육청",
      "AREA": "부산광역시",
      "AREA_ALIAS": "부산",
      "DOMAIN": "pen"
    },
    {
      "UUID": "7380000",
      "NAME": "광주광역시교육청",
      "AREA": "광주광역시",
      "AREA_ALIAS": "광주",
      "DOMAIN": "gen"
    },
    {
      "UUID": "7430000",
      "NAME": "대전광역시교육청",
      "AREA": "대전광역시",
      "AREA_ALIAS": "대전",
      "DOMAIN": "dje"
    },
    {
      "UUID": "7240000",
      "NAME": "대구광역시교육청",
      "AREA": "대구광역시",
      "AREA_ALIAS": "대구",
      "DOMAIN": "dge"
    },
    {
      "UUID": "7480000",
      "NAME": "울산광역시교육청",
      "AREA": "울산광역시",
      "AREA_ALIAS": "울산",
      "DOMAIN": "use"
    }
  ]
}</code></pre>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <span class="badge badge-primary">GET</span> region/offices/<i class="text-muted">{UUID}</i>
                    </div>
                    <div class="card-body">
                        기관 고유 코드를 이용한 소속 교육지원청 목록을 반환합니다.
                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Request</h6>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="font-weight-bold">CODE</span> - 기관 고유 코드</li>
                        </ul>

                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Response <span class="badge badge-dark">JSON</span></h6>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="font-weight-bold">UUID</span> - 기관 고유 코드</li>
                            <li class="list-group-item"><span class="font-weight-bold">NAME</span> - 기관명</li>
                            <li class="list-group-item"><span class="font-weight-bold">AREA</span> - 관할 지역명</li>
                            <li class="list-group-item"><span class="font-weight-bold">AREA_ALIAS</span> - 관할 지역명 2글자</li>
                            <li class="list-group-item"><span class="font-weight-bold">DOMAIN</span> - NEIS 고유 코드</li>
                        </ul>

                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Example Request</h6>
                        <span class="d-block mb-2">{{ route('api.region.getOffices', 7010000) }}</span>
                        <pre><code class="json">{
  "status": {
    "code": 200,
    "message": "Successful",
    "size": 13
  },
  "body": [
    {
      "UUID": "7061000",
      "NAME": "중부교육지원청",
      "NAME_LONG": "서울특별시중부교육지원청"
    },
    {
      "UUID": "7111000",
      "NAME": "성동광진교육지원청",
      "NAME_LONG": "서울특별시성동광진교육지원청"
    },
    {
      "UUID": "7021000",
      "NAME": "동부교육지원청",
      "NAME_LONG": "서울특별시동부교육지원청"
    },
    {
      "UUID": "7121000",
      "NAME": "성북강북교육지원청",
      "NAME_LONG": "서울특별시성북강북교육지원청"
    },
    {
      "UUID": "7051000",
      "NAME": "북부교육지원청",
      "NAME_LONG": "서울특별시북부교육지원청"
    },
    {
      "UUID": "7031000",
      "NAME": "서부교육지원청",
      "NAME_LONG": "서울특별시서부교육지원청"
    },
    {
      "UUID": "7081000",
      "NAME": "강서양천교육지원청",
      "NAME_LONG": "서울특별시강서양천교육지원청"
    },
    {
      "UUID": "7041000",
      "NAME": "남부교육지원청",
      "NAME_LONG": "서울특별시남부교육지원청"
    },
    {
      "UUID": "7101000",
      "NAME": "동작관악교육지원청",
      "NAME_LONG": "서울특별시동작관악교육지원청"
    },
    {
      "UUID": "7091000",
      "NAME": "강남서초교육지원청",
      "NAME_LONG": "서울특별시강남서초교육지원청"
    },
    {
      "UUID": "7071000",
      "NAME": "강동송파교육지원청",
      "NAME_LONG": "서울특별시강동송파교육지원청"
    },
    {
      "UUID": "0000000",
      "NAME": "서울특별시교육청",
      "NAME_LONG": "서울특별시교육청"
    },
    {
      "UUID": "0000000",
      "NAME": "서울특별시교육청",
      "NAME_LONG": "교육부"
    }
  ]
}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
