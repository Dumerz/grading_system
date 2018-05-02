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
      <a href="{{ route('course_managed_period', $course->id) }}">Periods</a>
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
          <i class="fa fa-calendar"></i> <a href="{{ route('course_managed_show', $course->id) }}">{{ __($course->name) }}</a> / <a href="{{ route('course_managed_period', $course->id) }}"> Periods</a> / <a href="{{ route('course_managed_period_show', ['course' => $course->id, 'period' => $period->id]) }}"> {{ __(title_case($period->description))}}</a> / Delete Period
        </div>
        <div class="card-body">
          <div class="text-center">
            <h4>You are about to delete period <strong>{{ $period->description }}</strong> from <strong>{{ $course->name }}</strong>?</h4>
            <p>Note: After deleting, period information cannot be restored. Enter your password to continue deleting the period.</p>
          </div>
          <form method="POST" action="{{ route('course_managed_period_handle_delete', ['course' => $course->id, 'period' => $period->id]) }}">
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
                        {{ __('Delete Period') }}
                    </button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  @component('courseperiod.components.actions', ['course' => $course, 'period' => $period])

  @endcomponent
  </div>
</div>
@endsection
