@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('course_managed_show', $item->course) }}">Course Managed</a>
    </li>
    <li class="breadcrumb-item active">
      <a href="{{ route('course_managed_period', $item->period) }}">Periods</a>
    </li>
    <li href="" class="breadcrumb-item active">Show</li>
  </ol>
  @if (session('status'))
    <div class="mx-auto alert alert-success">
      {{ session('status') }}
    </div>
  @elseif ($errors->any())
    <div class="mx-auto alert alert-warning">
      {{ $errors->first() }}
    </div>
  @endif
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-calendar"></i> <a href="{{ route('course_managed_show', $item->course) }}">{{ __($item->_course->description) }}</a> / <a href="{{ route('course_managed_period', $item->course) }}"> {{ __($item->_period->description) }}</a> / <a href="{{ route('course_managed_period_show', ['course' => $item->course, 'period' => $item->period]) }}"> {{ __(title_case($item->description))}}</a> / Grade
    </div>
    <div class="card-body">
      <form method="POST" action="">
      @csrf
      @foreach ($student as $stud)
        <div class="form-group row">
          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
            <label for="name" class="col-md-6 col-form-label text-md-left">
                <a href="{{ route('user_profile_show', $stud->_user->id) }}">{{ __($stud->_user->name_full) }}</a>
            </label>
            </div>
          </div>
        </div>
      @endforeach
        <div class="form-group row">
          <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Score') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="number" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="score" value="{{ old('score') }}" placeholder="Score" autofocus required>
              @if ($errors->has('score'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('score') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Max Score') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
            <label for="name" class="col-md-6 col-form-label text-md-left">
                {{ $item->max_score }}
            </label>
            </div>
          </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Grade') }}
                </button>
            </div>
        </div>
      </form>
    </div>
    <div class="card-footer">
    <div class="row float-right">
      {{ $student->links('vendor.pagination.simple-bootstrap-4') }}
    </div>
    </div>
  </div>
</div>
@endsection
