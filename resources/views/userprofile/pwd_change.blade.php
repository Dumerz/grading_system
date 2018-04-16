@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      User Profile
    </li>
    <li class="breadcrumb-item active">Change Password</li>
  </ol>
  <div class="row">
    <div class="col-lg-9 col-md-12 mb-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-key"></i> User Change Password
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('user_profile_handle_change_password', $user->id) }}">
          @csrf
            <div class="form-group row">
              <label for="password_old" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>
              <div class="col-md-6">
                <div class="input-group mb-2 mr-sm-2">
                  <input type="password" class="form-control {{ $errors->has('password_old') ? ' is-invalid' : '' }}" name="password_old" id="password_old" autofocus required>
                  @if ($errors->has('password_old'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('password_old') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
              <div class="col-md-6">
                <div class="input-group mb-2 mr-sm-2">
                  <input type="password" class="form-control {{ $errors->has('password_new') ? ' is-invalid' : '' }}" name="password_new" id="password_new" autofocus required>
                  @if ($errors->has('password_new'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('password_new') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="password_new_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
              <div class="col-md-6">
                <div class="input-group mb-2 mr-sm-2">
                  <input type="password" class="form-control {{ $errors->has('password_new_confirmation') ? ' is-invalid' : '' }}" name="password_new_confirmation" id="password_new_confirmation" autofocus required>
                  @if ($errors->has('password_new_confirmation'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('password_new_confirmation') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Change Password') }}
                    </button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  @component('user.components.actions', ['user' => $user])

  @endcomponent
  </div>
</div>
@endsection
