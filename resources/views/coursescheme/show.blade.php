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
      <a href="{{ route('course_managed_scheme', $course->id) }}">Schemes</a>
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
      <i class="fa fa-calendar"></i> <a href="{{ route('course_managed_show', $course->id) }}">{{ __($course->name) }}</a> / <a href="{{ route('course_managed_scheme', $course->id) }}"> Schemes</a> / {{ __(title_case($scheme->description))}} / Show
      <a href="{{ route('course_managed_scheme_update', ['course' => $course->id, 'scheme' => $scheme->id]) }}" class="btn-sm btn-success float-right">
      <i class="fa fa-plus"></i> 
      {{ __('Update Scheme') }}
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <tbody>
              <tr>
                <td>Period</td>
                <td>{{ __(title_case($scheme->description))}}</td>
              </tr>
              <tr>
                <td>Date Created</td>
                <td>{{ __($scheme->created_at->diffForHumans()) }}</td>
              </tr>
              <tr>
                <td>Date Updated</td>
                <td>{{ __($scheme->updated_at->diffForHumans()) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
  </div>
  </div>
  @component('coursescheme.components.actions', ['course' => $course, 'scheme' => $scheme])

  @endcomponent
  </div>
  </div>
@endsection
