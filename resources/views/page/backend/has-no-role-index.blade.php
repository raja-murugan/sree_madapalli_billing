@extends('layout.backend.guest')

@section('content')
    <div class="error_container">
        <div class="error-box">
            <h1 style="color: #751818;font-size: 147px;font-weight: 900;text-align: center;">403</h1>
            <h3 class="h2 mb-3 text-center"> Access Denied</h3>
            <p class="h4 font-weight-normal text-center">Sorry, but you don't have permission to access this page<br />You
                can go back to <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="">Previous
                    Page</a></p>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                @csrf
            </form>
        </div>
    </div>


    {{-- <div class="error-box error-page">
        <h1>500</h1>
        <h3 class="h2 mb-3"><i class="fas fa-exclamation-circle"></i> Oops! Something went wrong</h3>
        <p class="h4 font-weight-normal">I have none of these roles</p>
        <a class="dropdown-item logout btn btn-primary" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div> --}}
@endsection
