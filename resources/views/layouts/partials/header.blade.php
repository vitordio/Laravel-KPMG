@php
    use App\Components\Biblioteca;
@endphp

<div class="header">
    <div class="logo logo-dark">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo/logo.png')}}" alt="Logo">
            <img class="logo-fold" src="{{ asset('assets/images/logo/favicon.png') }}" alt="Logo">
        </a>
    </div>
    <div class="nav-wrap">
        <ul class="nav-left">
        </ul>

        <ul class="nav-right">
            <li class="dropdown dropdown-animated scale-left">
                <div class="pointer" data-toggle="dropdown">
                    <div class="avatar avatar-header avatar-image  m-h-10 m-r-15">
                        <i class="anticon anticon-user"></i>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
