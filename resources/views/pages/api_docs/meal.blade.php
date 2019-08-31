@extends('layout')

@section('title', '급식 API')

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
                        <span class="badge badge-primary">GET</span> meal
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
                            <li class="list-group-item"><span class="font-weight-bold">BREAKFAST</span> - 조식</li>
                            <li class="list-group-item"><span class="font-weight-bold">LUNCH</span> - 중식</li>
                            <li class="list-group-item"><span class="font-weight-bold">DINNER</span> - 석식</li>
                        </ul>

                        <hr class="card-split">
                        <h6 class="font-weight-bold"><i class="fas fa-angle-right"></i> Example Request</h6>
                        <span class="d-block mb-2">{{ route('api.meal.getMeal', ['school' => '고려고등학교', 'code' => 'F100000088', 'date' => '2019-08-27']) }}</span>
                        <pre><code class="json">{
  "status": {
    "code": 200,
    "message": "Successful",
    "size": 4
  },
  "body": {
    "SCHOOL": "고려고등학교",
    "NEIS_CODE": "F100000088",
    "DATE": "2019.08.27",
    "MEAL": {
      "BREAKFAST": [
        "백미밥",
        "호박된장국5.6.13.",
        "팝콘2.5.",
        "왕새우튀김/케첩1.5.6.9.12.13.",
        "배추김치9.13.",
        "딸기우유2.",
        "닭갈비5.6.13.15."
      ],
      "LUNCH": [
        "백미밥",
        "감자된장국5.6.13.",
        "잡채5.6.8.10.13.",
        "배추김치9.13.",
        "갈릭파이1.2.5.6.13.",
        "파채돈까스1.2.5.6.10.12.13."
      ],
      "DINNER": [
        "백미밥",
        "돈갈비탕5.6.10.13.18.",
        "깍두기9.13.",
        "어묵달걀전1.5.6.13.",
        "미트볼떡조림5.6.10.12.13."
      ]
    }
  }
}</code></pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
