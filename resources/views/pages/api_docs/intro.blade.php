@extends('layout')

@section('title', 'API 이용안내')

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
                        <span class="badge badge-primary">v1</span> API Endpoint
                    </div>
                    <div class="card-body">
                        {{ url('api') }}
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        Response Structure <span class="badge badge-dark">JSON</span>
                    </div>
                    <div class="card-body">
                        <ul class="list-group mb-3">
                            <li class="list-group-item"><span class="font-weight-bold">code</span> - edupedia return code</li>
                            <li class="list-group-item"><span class="font-weight-bold">message</span> - edupedia return message</li>
                            <li class="list-group-item"><span class="font-weight-bold">size</span> - Data size</li>
                            <li class="list-group-item"><span class="font-weight-bold">body</span> - Response data</li>
                        </ul>

                        <pre><code class="json">{
  "status": {
    "code": 200,
    "message": "Successful",
    "size": 1
  },
  "body": [
    {
      ...
    }
  ]
}</code></pre>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">Status Information</div>
                    <div class="card-body">
                        Same as standard HTTP return status <br>
                        (상세 오류 정보는 제공 준비중입니다.)
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
