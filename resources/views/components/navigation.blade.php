<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark py-1">
    <div class="container">
        <a class="navbar-brand" href="{{ config('app.url') }}">
            <img src="/media/symbol.png" alt="Symbol" class="brand-logo">
            {{ config('app.name') }}
        </a>
        <div class="togglers mt-1">
            <a class="navbar-toggler d-lg-none" href="#" data-toggle="collapse" data-target="#nav_user">
                <i class="fas fa-user fa-fw"></i>
            </a>
            <a class="navbar-toggler d-lg-none" href="#" data-toggle="collapse" data-target="#nav_main">
                <i class="fas fa-bars fa-fw"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="nav_main">
            <ul class="navbar-nav mr-auto mt-2 mt-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('api_docs.intro') }}">이용 안내</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('api_docs.region') }}">교육청</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('api_docs.office') }}">교육지원청</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('api_docs.school') }}">학교 검색</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('api_docs.meal') }}">급식</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('api_docs.calendar') }}">학사일정</a>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="nav_user">
            <ul class="navbar-nav ml-auto mt-2 mt-md-0">
                @if(Auth::check())
                    {{-- Logged In --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile', Auth::user()->uuid) }}"><i class="fas fa-user fa-fw"></i> {{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                    <form action="{{ route('auth.logout') }}" method="post" id="logoutForm">
                        @csrf
                        @method('delete')
                        <a onclick="$('#logoutForm').submit();" href="#logout" class="nav-link"><i class="fas fa-sign-out-alt fa-fw"></i> 로그아웃</a>
                    </form>
                    </li>
                @else
                    {{-- Logged Out --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.login') }}"><i class="fas fa-sign-in-alt fa-fw"></i> 로그인</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.register') }}"><i class="fas fa-user-plus fa-fw"></i> 회원가입</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
