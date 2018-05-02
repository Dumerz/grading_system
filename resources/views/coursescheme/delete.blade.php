@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('course_managed_show', $course->id) }}">Course</a>
    </li>
    <li class="breadcrumb-item active">
      <a href="{{ route('course_managed_scheme', $course->id) }}">Schemes</a>
    </li>
    <li href="" class="breadcrumb-item active">Delete</li>
  </ol>
  @if (session('warning'))
  <div class="alert alert-warning">
      {{ session('warning') }}
  </div>
  @endif
  <div class="row">
    <div class="col-lg-9 col-md-12 mb-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-calendar"></i> <a href="{{ route('course_managed_show', $course->id) }}">{{ __($course->name) }}</a> / <a href="{{ route('course_managed_scheme', $course->id) }}"> Schemes</a> / <a href="{{ route('course_managed_scheme_show', ['course' => $course->id, 'scheme' => $scheme->id]) }}"> {{ __(title_case($scheme->description))}}</a> / Delete Scheme
        </div>
        <div class="card-body">
          <div class="text-center">
            <h4>You are about to delete scheme <strong>{{ $scheme->description }}</strong> from <strong>{{ $course->name }}</strong>?</h4>
            <p>Note: After deleting, scheme information cannot be restored. Enter your password to continue deleting the scheme.</p>
          </div>
          <form method="POST" action="{{ route('course_managed_scheme_handle_delete', ['course' => $course->id, 'scheme' => $scheme->id]) }}">
          @csrf
            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
              <div class="col-md-6">
                <div class="input-group mb-2 mr-sm-2">
                  <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" autofocus required>
                  @if ($errors->has('password'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-danger">
                        {{ __('Delete Scheme') }}
                    </button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  @component('coursescheme.components.actions', ['course' => $course, 'scheme' => $scheme])

  @endcomponent
  </div>
</div>
@endsection
