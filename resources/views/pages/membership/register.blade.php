@extends('layout')

@section('title', '회원가입')

@section('content')
    <div class="container membership">
        <div class="row">
            @include('pages.membership.sidebar')
            <div class="col-md-9" id="register">
                @include('components.page-header')
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <form action="{{ route('auth.register') }}" method="post">
                                    @csrf

                                    <label for="email" @error('email') class="text-danger" @enderror>이메일</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" placeholder="이메일" required autofocus>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                    <label for="name" @error('name') class="text-danger" @enderror>이름</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}" placeholder="이름" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                    <label for="password" @error('password') class="text-danger" @enderror>비밀번호</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password" placeholder="비밀번호" required>
                                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                    <label for="password_check" @error('password_check') class="text-danger" @enderror>비밀번호 확인</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password_check" placeholder="비밀번호 확인" required>
                                    @error('password_check')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                    <button type="submit" class="btn btn-primary btn-block">회원가입</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
