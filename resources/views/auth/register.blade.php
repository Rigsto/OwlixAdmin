@extends('layouts.auth')
@section('content')
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{ asset('img/logo.svg') }}" alt="" style="max-width: 80%">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="{{ route('auth.register') }}" style="margin-top: 20px">
                @include('layouts.alert')
                @csrf
                <div class="form-group">
                    <input name="full_name" id="full_name" type="text" class="form-control rounded-pill" placeholder="Full Name" required autocomplete="off">
                </div>
                <div class="form-group">
                    <input name="email" id="email" type="email" class="form-control rounded-pill" placeholder="Email" required autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control rounded-pill" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control rounded-pill" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-block rounded-pill" style="background-color: #0020dd">REGISTER</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            Have any account? <a href="{{ route('auth.showLogin') }}">Login Here</a>
        </div>
    </div>
@endsection
