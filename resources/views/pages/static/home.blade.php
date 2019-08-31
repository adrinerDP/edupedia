@extends('layout')

@section('resource')
    <script>
        $(function () {
            let searchSchool = $('#searchSchool');
            let searchMeal = $('#searchMeal');

            searchSchool.on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '/api/school/'+searchSchool.find('#schoolName').val(),
                    error: function (req) {
                        swiftalert('학교를 찾을 수 없어요 :( ['+req.status+']', 'danger', {closable:false});
                    }
                }).done(function(data) {
                    searchSchool.find('.result').html('');
                    searchMeal.find('#schoolName').val(data.body[0]['NAME']);
                    searchMeal.find('#schoolCode').val(data.body[0]['NEIS_CODE']);
                    swiftalert('첫 검색 결과를 입력 했어요!', 'success', {closable:false});
                    data.body.forEach(function (value) {
                        searchSchool.find('.result').append(
                            '<div class="card mb-1">\n' +
                            '<div class="card-body">\n' +
                            '<h5 class="font-weight-bold mb-1">\n' +
                            '<span class="badge badge-dark" style="vertical-align:bottom">'+value['LOCATION']['AREA']+'</span>\n' +
                            '<span class="badge badge-dark" style="vertical-align:bottom">'+value['DETAIL']['COURSE_TYPE']+'</span>\n' +
                            value['NAME'] +
                            '</h5>\n' +
                            '<p class="m-0"><i class="fas fa-map-marker-alt fa-fw"></i> '+value['LOCATION']['ADDRESS_NEW']+'</p>\n' +
                            '<p class="m-0"><i class="fas fa-cog fa-fw"></i> '+value['NEIS_CODE']+'</p>\n' +
                            '</div>\n' +
                            '</div>'
                        );
                    })
                });
            });

            searchMeal.on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '/api/meal?school='+searchMeal.find('#schoolName').val()+'&code='+searchMeal.find('#schoolCode').val()+'&date='+searchMeal.find('#searchDate').val(),
                    error: function (req) {
                        swiftalert('정보를 가져올 수 없어요 :( ['+req.status+']', 'danger', {closable:false});
                    }
                }).done(function(data) {
                    searchMeal.find('.result').removeClass('d-none');
                    searchMeal.find('#breakfast').html('');
                    searchMeal.find('#lunch').html('');
                    searchMeal.find('#dinner').html('');
                    let isNull = true;
                    if (data.body.MEAL.BREAKFAST != null) {
                        data.body.MEAL.BREAKFAST.forEach(function(value) {
                            searchMeal.find('#breakfast').append('<span class="badge badge-light mr-2">'+value+'</span>');
                        });
                        isNull = false;
                    } else {
                        searchMeal.find('#breakfast').parent().parent().remove();
                    }

                    if (data.body.MEAL.LUNCH != null) {
                        data.body.MEAL.LUNCH.forEach(function (value) {
                            searchMeal.find('#lunch').append('<span class="badge badge-light mr-2">' + value + '</span>');
                        });
                        isNull = false;
                    } else {
                        searchMeal.find('#lunch').parent().parent().remove();
                    }

                    if (data.body.MEAL.DINNER != null) {
                        data.body.MEAL.DINNER.forEach(function (value) {
                            searchMeal.find('#dinner').append('<span class="badge badge-light mr-2">' + value + '</span>');
                        });
                        isNull = false;
                    } else {
                        searchMeal.find('#dinner').parent().parent().remove();
                    }

                    if (isNull) {
                        swiftalert('급식이 없는 날이에요 :(', 'warning', {closable:false});
                    }
                });
            })
        })
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box mb-3" style="background:#FFFFFF;color:#000000">
                    <div class="box-title bg-light">
                        <i class="fas fa-server fa-fw"></i> EDUPEDIA 데이터베이스 현황
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box mb-3" style="background:#FFFFFF;color:#000000">
                    <div class="box-title bg-light">
                        시도교육청
                    </div>
                    <div class="box-body text-center py-3">
                        <h1 class="font-weight-bold mb-0">{{ \App\Models\Region::count() }}<small>건</small></h1>
                    </div>
                    <a href="{{ route('api_docs.region') }}">
                        <div class="box-link">
                            교육청 API 명세
                            <i class="fas fa-arrow-right fa-pull-right mt-1"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box mb-3" style="background:#FFFFFF;color:#000000">
                    <div class="box-title bg-light">
                        교육지원청
                    </div>
                    <div class="box-body text-center py-3">
                        <h1 class="font-weight-bold mb-0">{{ \App\Models\Office::count() }}<small>건</small></h1>
                    </div>
                    <a href="{{ route('api_docs.office') }}">
                        <div class="box-link">
                            교육지원청 API 명세
                            <i class="fas fa-arrow-right fa-pull-right mt-1"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box mb-3" style="background:#FFFFFF;color:#000000">
                    <div class="box-title bg-light">
                        각급 학교
                    </div>
                    <div class="box-body text-center py-3">
                        <h1 class="font-weight-bold mb-0">{{ \App\Models\School::count() }}<small>건</small></h1>
                    </div>
                    <a href="{{ route('api_docs.school') }}">
                        <div class="box-link">
                            학교 정보 API 명세
                            <i class="fas fa-arrow-right fa-pull-right mt-1"></i>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-12">
                <div class="box mb-3" style="background:#FFFFFF;color:#000000">
                    <div class="box-title bg-light">
                        <i class="fas fa-cog fa-fw"></i> 원천 정보 서비스 접속 상태
                    </div>
                    <div class="box-body">
                        <i class="fas fa-circle fa-fw text-success"></i> 에듀피디아 데이터베이스
                        <hr class="card-split">
                        <i class="fas fa-circle fa-fw text-success"></i> 나이스 급식 정보
                        <hr class="card-split">
                        <i class="fas fa-circle fa-fw text-success"></i> 나이스 학사일정 정보
                        <hr class="card-split">
                        <i class="fas fa-circle fa-fw text-success"></i> KERIS 학교알리미
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <form class="box mb-3" style="background:#FFFFFF;color:#000000" id="searchSchool">
                    <div class="box-title bg-light">
                        <i class="fas fa-search"></i> 학교 검색
                    </div>
                    <div class="box-body">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="schoolName" id="schoolName">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text font-weight-bold">
                                    <i class="fas fa-search"></i> 검색
                                </button>
                            </div>
                        </div>
                        <div class="result" style="max-height: 200px;overflow: auto;">
                            <div class="empty text-center py-3">
                                <h3 class="text-muted mb-0">검색어를 입력 해 주세요!</h3>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-6">
                <form class="box mb-3" style="background:#FFFFFF;color:#000000" id="searchMeal">
                    <div class="box-title bg-light">
                        <i class="fas fa-search"></i> 급식 조회
                    </div>
                    <div class="box-body">
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold">
                                    학교명
                                </span>
                            </div>
                            <input type="text" class="form-control" name="schoolName" id="schoolName" placeholder="학교명">
                        </div>

                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold">
                                    NEIS 코드
                                </span>
                            </div>
                            <input type="text" class="form-control" name="schoolCode" id="schoolCode" placeholder="NEIS 코드">
                        </div>

                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text font-weight-bold">
                                    검색 일자
                                </span>
                            </div>
                            <input type="date" class="form-control" name="searchDate" id="searchDate" placeholder="검색 일자" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-block"><i class="fas fa-search"></i> 검색</button>

                        <div class="result d-none mt-2">
                            <div class="card mb-1">
                                <div class="card-body">
                                    <h5 class="font-weight-bold mb-1">조식</h5>
                                    <div id="breakfast" class="mb-1">

                                    </div>
                                </div>
                            </div>
                            <div class="card mb-1">
                                <div class="card-body">
                                    <h5 class="font-weight-bold mb-1">중식</h5>
                                    <div id="lunch" class="mb-1">

                                    </div>
                                </div>
                            </div>
                            <div class="card mb-1">
                                <div class="card-body">
                                    <h5 class="font-weight-bold mb-1">석식</h5>
                                    <div id="dinner" class="mb-1">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
