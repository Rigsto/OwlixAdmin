@extends('layouts.auth')
@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset('img/logo.svg') }}" alt="" style="max-width: 80%">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('auth.login') }}" style="margin-top: 20px">
                @include('layouts.alert')
                @csrf
                <div class="form-group">
                    <input name="email" id="email" type="email" class="form-control rounded-pill" placeholder="Email" required autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control rounded-pill" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block rounded-pill" style="background-color: #0020dd">LOGIN</button>
                </div>
            </form>
        </div>
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-md-12 text-center">--}}
{{--            Don't have any account? <a href="{{ route('auth.showRegister') }}">Register Now</a>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
