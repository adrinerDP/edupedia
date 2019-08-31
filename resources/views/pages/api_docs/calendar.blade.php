@extends('layout')

@section('title', '학사일정 API')

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
                        <span class="badge badge-primary">GET</span> calendar
                    </div>
                    <div class="card-body">
                        해당 학교의 급식을 조회합니다.
                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Request</h6>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="font-weight-bold">school</span> - 학교명</li>
                            <li class="list-group-item"><span class="font-weight-bold">code</span> - 기관 NEIS 고유 코드</li>
                            <li class="list-group-item">
                                <span class="font-weight-bold">date</span> - 조회일자
                                <small class="text-muted">(형식: Y-m-d / 예:2019-01-01)</small>
                            </li>
                        </ul>

                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Response <span class="badge badge-dark">JSON</span></h6>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="font-weight-bold">SCHOOL</span> - 학교명</li>
                            <li class="list-group-item"><span class="font-weight-bold">NEIS_CODE</span> - 기관 NEIS 고유 코드</li>
                            <li class="list-group-item"><span class="font-weight-bold">DATE</span> - 조회일자</li>
                            <li class="list-group-item"><span class="font-weight-bold">CALENDAR</span> - 학사일정</li>
                        </ul>

                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Example Request</h6>
                        <span class="d-block mb-2">{{ route('api.calendar.getCalendar', ['school' => '고려고등학교', 'code' => 'F100000088', 'date' => '2019-08-19']) }}</span>
                        <pre><code class="json">{
  "status": {
    "code": 200,
    "message": "Successful",
    "size": 4
  },
  "body": {
    "SCHOOL": "고려고등학교",
    "NEIS_CODE": "F100000088",
    "DATE": "2019.08.19",
    "CALENDAR": [
      "과제탐구제출 마감"
    ]
  }
}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
