@extends('layout')

@section('title', '내 정보')

@section('content')
    <div class="container membership">
        <div class="row">
            @include('pages.membership.sidebar')
            <div class="col-md-9" id="profile">
                <div class="header">
                    <h2>내 정보</h2>
                </div>
                <div class="card mb-3">
                    <div class="card-body text-center py-3">
                        <h3>
                            <span class="font-weight-bold">{{ auth()->user()->name }}</span>
                            <small>님, 안녕하세요!</small>
                        </h3>
                        <p class="m-0"><i class="fas fa-envelope fa-fw"></i> {{ auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        정보 수정
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile', auth()->user()->uuid) }}" method="post">
                            @csrf
                            <label for="uuid" @error('uuid') class="text-danger" @enderror>UUID</label>
                            <input type="text" class="form-control @error('uuid') is-invalid @enderror"
                                   name="uuid" placeholder="UUID" value="{{ auth()->user()->uuid }}" required>
                            @error('uuid')<div class="invalid-feedback">{{ $message }}</div>@enderror

                            <label for="email">이메일</label>
                            <input type="email" class="form-control" value="{{ auth()->user()->email }}" disabled>

                            <label for="name" @error('name') class="text-danger" @enderror>이름</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" placeholder="이름" value="{{ auth()->user()->name }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror

                            <button type="submit" class="btn btn-primary btn-block mb-0">정보 수정</button>
                        </form>

                        <hr class="card-split">

                        <form action="{{ route('auth.password') }}" method="post">
                            <label for="password" @error('password') class="text-danger" @enderror>현재 비밀번호</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password" placeholder="현재 비밀번호" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror

                            <label for="password_new" @error('password_new') class="text-danger" @enderror>새로운 비밀번호</label>
                            <input type="password" class="form-control @error('password_new') is-invalid @enderror"
                                   name="password_new" placeholder="비밀번호" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror

                            <label for="password_check" @error('password_check') class="text-danger" @enderror>비밀번호 확인</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   name="password_check" placeholder="비밀번호 확인" required>
                            @error('password_check')<div class="invalid-feedback">{{ $message }}</div>@enderror

                            <button type="submit" class="btn btn-primary btn-block mb-0">비밀번호 변경</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
