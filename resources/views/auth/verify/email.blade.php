@extends('layouts.app')

@section('content')
<div class="container">
@if (session('status'))
    <div class="card-login mx-auto alert alert-success">
        {{ session('status') }}
    </div>
@endif
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">{{ __('Verify Account') }}</div>
        <div class="card-body">
                <div class="text-center mt-4 mb-5">
                    <h4>Didn't received your verification?</h4>
                    <p>Enter your email address and we will send you instructions on how to verify your account.</p>
                </div>
            <form method="POST" action="{{ route('handle_verify') }}">
                @csrf
                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{__('Enter email address')}}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Send Account Verification Link') }}
                    </button>
            </form>
            <div class="text-center">
            <a class="d-block small mt-3" href="{{route('register')}}">Register an Account</a>
            <a class="d-block small" href="{{route('login')}}">Login Page</a>
            </div>
        </div>
    </div>
</div>
@endsection
