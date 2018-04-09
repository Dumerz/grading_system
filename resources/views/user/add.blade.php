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
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-user-plus"></i> Add User
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('user_handle_add') }}">
      @csrf
        <div class="form-group row">
          <label for="name_first" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="text" class="form-control {{ $errors->has('name_first') ? ' is-invalid' : '' }}" name="name_first" id="name_first" value="{{ old('name_first') }}" placeholder="First Name" autofocus required>
              @if ($errors->has('name_first'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('name_first') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="name_middle" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="text" class="form-control {{ $errors->has('name_middle') ? ' is-invalid' : '' }}" name="name_middle" id="name_middle" value="{{ old('name_middle') }}" placeholder="Middle Name">
              @if ($errors->has('name_middle'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('name_middle') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="name_last" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="text" class="form-control {{ $errors->has('name_last') ? ' is-invalid' : '' }}" name="name_last" id="name_last" value="{{ old('name_last') }}" placeholder="Last Name" required>
              @if ($errors->has('name_last'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('name_last') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="name_suffix" class="col-md-4 col-form-label text-md-right">{{ __('Name Suffix') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="text" class="form-control {{ $errors->has('name_suffix') ? ' is-invalid' : '' }}" name="name_suffix" id="name_suffix" value="{{ old('name_suffix') }}" placeholder="Name Suffix">
              @if ($errors->has('name_suffix'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('name_suffix') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <select class="form-control {{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" id="gender"  required>
                  <option value="MALE"
                    @if (old('gender') == "MALE"))
                        selected 
                    @endif
                    >Male</option>
                  <option value="FEMALE"
                    @if (old('gender') == "FEMALE"))
                        selected 
                    @endif
                    >Female</option>
              </select>
              @if ($errors->has('gender'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('gender') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="usertype" class="col-md-4 col-form-label text-md-right">{{ __('Usertype') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <select class="form-control {{ $errors->has('usertype') ? ' is-invalid' : '' }}" name="usertype" id="usertype" required>
                @foreach ($usertypes as $usertype)
                  <option value="{{ __($usertype->usertype_id) }}"
                    @if (old('usertype') == $usertype->usertype_id))
                        selected 
                    @endif
                   >{{ __(title_case($usertype->description)) }}</option>
                @endforeach
              </select>
              @if ($errors->has('usertype'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('usertype') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="userstatus" class="col-md-4 col-form-label text-md-right">{{ __('Userstatus') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <select class="form-control {{ $errors->has('userstatus') ? ' is-invalid' : '' }}" name="userstatus" id="userstatus" required>
                @foreach ($userstatus as $userstat)
                  <option value="{{ __($userstat->userstatus_id) }}"
                    @if (old('userstatus') == $userstat->userstatus_id))
                        selected 
                    @endif
                  >{{ __(title_case($userstat->description)) }}</option>
                @endforeach
              </select>
              @if ($errors->has('userstatus'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('userstatus') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="date_birth" class="col-md-4 col-form-label text-md-right">{{ __('Birth Date') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="date" class="form-control {{ $errors->has('date_birth') ? ' is-invalid' : '' }}" name="date_birth" id="date_birth" value="{{ old('date_birth') }}" required>
              @if ($errors->has('date_birth'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('date_birth') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}" placeholder="example.ogs.dev" required>
              @if ($errors->has('email'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name') }}" placeholder="Username" required>
              @if ($errors->has('name'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" value="{{ old('password') }}" placeholder="Password" required>
              @if ($errors->has('password'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="password" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Password Confirmation" required>
              @if ($errors->has('password_confirmation'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Add User') }}
                </button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
