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
    <li class="breadcrumb-item active">Scheme</li>
  </ol>
  @if (session('status'))
    <div class="mx-auto alert alert-success">
      {{ session('status') }}
    </div>
  @elseif (session('warning'))
    <div class="alert alert-warning">
      {{ session('warning') }}
    </div>
  @endif
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-calendar"></i> <a href="{{ route('course_managed_show', $course->id) }}">{{ __($course->name) }}</a> / Distribute Schemes
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('course_managed_scheme_handle_distribute', $course->id) }}">
      @csrf
        <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Schemes') }}</label>
          <div class="col-md-6">
            <label for="password" class="col-form-label">{{ __('Percentage %') }}</label>
          </div>
        </div>
      @foreach ($schemes as $scheme)
        <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __($scheme->description) }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="text" class="form-control" name="scheme[{{ __($scheme->id) }}]" id="scheme[{{ __($scheme->id) }}]" autofocus required>
              <div class="input-group-prepend">
                <div class="input-group-text">%</div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-success">
                    {{ __('Distribute Schemes') }}
                </button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
