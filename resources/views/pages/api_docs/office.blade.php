@extends('layout')

@section('title', '교육지원청 API')

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
                        <span class="badge badge-primary">GET</span> office/uuid/<i class="text-muted">{UUID}</i>
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
                            <li class="list-group-item"><span class="font-weight-bold">REGION</span> - 소속 REGION</li>
                            <li class="list-group-item"><span class="font-weight-bold">NAME</span> - 기관명</li>
                            <li class="list-group-item"><span class="font-weight-bold">NAME_LONG</span> - REGION 포함 기관명</li>
                        </ul>

                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Example Request</h6>
                        <span class="d-block mb-2">{{ route('api.office.getByUUID', 7251000) }}</span>
                        <pre><code class="json">{
  "status": {
    "code": 200,
    "message": "Successful",
    "size": 1
  },
  "body": [
    {
      "UUID": 7251000,
      "REGION": {
        "UUID": 7240000,
        "NAME": "대구광역시교육청",
        "AREA": "대구광역시",
        "AREA_ALIAS": "대구",
        "DOMAIN": "dge"
      },
      "NAME": "동부교육지원청",
      "NAME_LONG": "대구광역시동부교육지원청"
    }
  ]
}</code></pre>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <span class="badge badge-primary">GET</span> office/name/<i class="text-muted">{KEYWORD}</i>
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
                            <li class="list-group-item"><span class="font-weight-bold">REGION</span> - 소속 REGION</li>
                            <li class="list-group-item"><span class="font-weight-bold">NAME</span> - 기관명</li>
                            <li class="list-group-item"><span class="font-weight-bold">NAME_LONG</span> - REGION 포함 기관명</li>
                        </ul>

                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Example Request</h6>
                        <span class="d-block mb-2">{{ route('api.office.getByName', '동부') }}</span>
                        <pre><code class="json">{
  "status": {
    "code": 200,
    "message": "Successful",
    "size": 5
  },
  "body": [
    {
      "UUID": 7251000,
      "REGION": {
        "UUID": 7240000,
        "NAME": "대구광역시교육청",
        "AREA": "대구광역시",
        "AREA_ALIAS": "대구",
        "DOMAIN": "dge"
      },
      "NAME": "동부교육지원청",
      "NAME_LONG": "대구광역시동부교육지원청"
    },
    {
      "UUID": 7021000,
      "REGION": {
        "UUID": 7010000,
        "NAME": "서울특별시교육청",
        "AREA": "서울특별시",
        "AREA_ALIAS": "서울",
        "DOMAIN": "sen"
      },
      "NAME": "동부교육지원청",
      "NAME_LONG": "서울특별시동부교육지원청"
    },
    {
      "UUID": 7391000,
      "REGION": {
        "UUID": 7380000,
        "NAME": "광주광역시교육청",
        "AREA": "광주광역시",
        "AREA_ALIAS": "광주",
        "DOMAIN": "gen"
      },
      "NAME": "동부교육지원청",
      "NAME_LONG": "광주광역시동부교육지원청"
    },
    {
      "UUID": 7441000,
      "REGION": {
        "UUID": 7430000,
        "NAME": "대전광역시교육청",
        "AREA": "대전광역시",
        "AREA_ALIAS": "대전",
        "DOMAIN": "dje"
      },
      "NAME": "동부교육지원청",
      "NAME_LONG": "대전광역시동부교육지원청"
    },
    {
      "UUID": 7341000,
      "REGION": {
        "UUID": 7310000,
        "NAME": "인천광역시교육청",
        "AREA": "인천광역시",
        "AREA_ALIAS": "인천",
        "DOMAIN": "ice"
      },
      "NAME": "동부교육지원청",
      "NAME_LONG": "인천광역시동부교육지원청"
    }
  ]
}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
