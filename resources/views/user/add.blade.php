@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('user') }}">Users</a>
    </li>
    <li href="" class="breadcrumb-item active">Add</li>
  </ol>
    <div class="row">
        <div class="col-6 m-1">
            <h1>Add User</h1>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name_first">{{ __('First Name') }}</label>
                    <input id="name_first" type="text" class="form-control{{ $errors->has('name_first') ? ' is-invalid' : '' }}" name="name_first" value="{{ old('name_first') }}" required autofocus>
                    @if ($errors->has('name_first'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name_first') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name_middle">{{ __('Middle Name') }}</label>
                    <input id="name_middle" type="text" class="form-control{{ $errors->has('name_middle') ? ' is-invalid' : '' }}" name="name_middle" value="{{ old('name_middle') }}" autofocus>
                    @if ($errors->has('name_middle'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name_middle') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name_last">{{ __('Last Name') }}</label>
                    <input id="name_last" type="text" class="form-control{{ $errors->has('name_last') ? ' is-invalid' : '' }}" name="name_last" value="{{ old('name_last') }}" required autofocus>

                    @if ($errors->has('name_last'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name_last') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="name_suffix">{{ __('Name Suffix') }}</label>
                    <input id="name_suffix" type="text" class="form-control{{ $errors->has('name_suffix') ? ' is-invalid' : '' }}" name="name_suffix" value="{{ old('name_suffix') }}" autofocus>
                    @if ($errors->has('name_suffix'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name_suffix') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="gender">{{ __('Gender') }}</label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="MALE">Male</option>
                            <option value="FEMALE">Female</option>
                        </select>
                </div>

                <div class="form-group">
                    <label for="date_birth">{{ __('Birth Date') }}</label>
                        <input id="date_birth" type="date" class="form-control{{ $errors->has('date_birth') ? ' is-invalid' : '' }}" name="date_birth" value="{{ old('date_birth') }}" required>

                        @if ($errors->has('date_birth'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('date_birth') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">{{ __('Username') }}</label>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
