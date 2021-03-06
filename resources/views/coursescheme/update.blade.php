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
    <li class="breadcrumb-item">
      <a href="{{ route('course_managed_scheme', $course->id) }}">Schemes</a>
    </li>
    <li href="" class="breadcrumb-item active">Update</li>
  </ol>
  <div class="row">
  <div class="col-lg-9 col-md-12 mb-3">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-calendar"></i> <a href="{{ route('course_managed_show', $course->id) }}">{{ __($course->name) }}</a> / <a href="{{ route('course_managed_scheme', $course->id) }}"> Schemes</a> / <a href="{{ route('course_managed_scheme_show', ['course' => $course->id, 'scheme' => $scheme->id]) }}"> {{ __(title_case($scheme->description))}}</a> / Update Scheme
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('course_managed_scheme_handle_update', ['course' => $course->id, 'scheme' => $scheme->id]) }}">
      @csrf
        <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Scheme') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="text" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" value="{{ $scheme->description }}" autofocus required>
              @if ($errors->has('description'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('description') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-success">
                    {{ __('Update Scheme') }}
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
