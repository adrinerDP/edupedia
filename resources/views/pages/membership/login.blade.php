@extends('layout')

@section('title', '로그인')

@section('resource')
    @if ($errors->any())<script>swiftalert('이메일이나 비밀번호를 확인해주세요!', 'danger', {closable:false})</script>@endif
@endsection

@section('content')
    <div class="container membership">
        <div class="row">
            @include('pages.membership.sidebar')
            <div class="col-md-9" id="login">
                @include('components.page-header')
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <form action="{{ route('auth.login') }}" method="post">
                                    @csrf
                                    <label for="email">이메일</label>
                                    <input type="email" class="form-control" name="email" placeholder="이메일" required autofocus>

                                    <label for="password">비밀번호</label>
                                    <input type="password" class="form-control" name="password" placeholder="비밀번호" required>

                                    <button type="submit" class="btn btn-primary btn-block">로그인</button>
                                </form>
                                <a href="{{ route('auth.register') }}" class="btn btn-outline-secondary btn-block btn-sm">회원가입</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
