@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('course') }}">Course</a>
    </li>
    <li class="breadcrumb-item active">Periods</li>
    <li class="breadcrumb-item active">Show</li>
  </ol>
  @if (session('status'))
    <div class="mx-auto alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  <div class="row">
  <div class="col-lg-8 col-md-12 mb-3">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-calendar"></i> Course Periods
    </div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <tbody>
            @foreach ($periods as $period)
              <tr>
                <td>{{ __($loop->iteration) }}</td>
                <td>{{ __(title_case($period->description))}}</td>
                <td>{{ __($period->created_at->diffForHumans()) }}</td>
                <td>{{ __($period->updated_at->diffForHumans()) }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
    </div>
  </div>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-calendar"></i> Add Course Periods
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('course_period_handle_add', $course->id) }}">
      @csrf
        <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Period') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="text" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" autofocus required>
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
                    {{ __('Add New Period') }}
                </button>
            </div>
        </div>
      </form>
    </div>
  </div>
  </div>
  @component('courseperiods.components.actions', ['course' => $course])

  @endcomponent
  </div>
  </div>
@endsection
