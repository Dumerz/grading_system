@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
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
      <i class="fa fa-calendar"></i> <a href="{{ route('course_managed_show', $course->id) }}">{{ __($course->name) }}</a> / <a href="{{ route('course_managed_period', $course->id) }}"> Periods</a> / {{ __(title_case($period->description))}} / Show
      <a href="{{ route('course_managed_period_update', ['course' => $course->id, 'period' => $period->id]) }}" class="btn-sm btn-success float-right">
      <i class="fa fa-edit"></i> 
      {{ __('Update Period') }}
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <tbody>
              <tr>
                <td>Period</td>
                <td>{{ __(title_case($period->description))}}</td>
              </tr>
              <tr>
                <td>Date Created</td>
                <td>{{ __($period->created_at->diffForHumans()) }}</td>
              </tr>
              <tr>
                <td>Date Updated</td>
                <td>{{ __($period->updated_at->diffForHumans()) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
  </div>
  </div>
  @component('courseperiod.components.actions', ['course' => $course, 'period' => $period])

  @endcomponent
  </div>
  </div>
@endsection
