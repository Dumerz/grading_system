@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('course_managed') }}">Course Managed</a>
    </li>
    <li class="breadcrumb-item active">Show</li>
  </ol>
  @if (session('status'))
    <div class="mx-auto alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  <div class="row">
  <div class="col-lg-9 col-md-12 mb-3">
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-briefcase"></i> Course Managed
        <a href="{{ route('course_managed_update', $course->id) }}" class="btn-sm btn-success float-right">
        <i class="fa fa-edit"></i> 
        {{ __('Update') }}
        </a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
              <tbody>
                <tr>
                  <td>Name</td>
                  <td>{{ __($course->name)}}</td>
                </tr>
                <tr>
                  <td>Description</td>
                  <td>{{ __(ucfirst($course->description))}}</td>
                </tr>
                <tr>
                  <td>Evaluator</td>
                  <td><a href="{{ route('user_profile_show', $course->evaluator_user->id ) }}">{{ __(title_case($course->evaluator_user->name_full))}}</a></td>
                </tr>
                <tr>
                  <td>No of Ratees</td>
                  <td><a href="{{ route('course_managed_student', $course->id ) }}">{{ __($course->total_students) }} {{ __(str_plural('student', $course->total_students)) }}</a></td>
                </tr>
                <tr>
                  <td>No of Periods</td>
                  <td><a href="{{ route('course_managed_period', $course->id ) }}">{{ __($course->total_periods) }} {{ __(str_plural('period', $course->total_periods)) }}</a></td>
                </tr>
                <tr>
                  <td>No of Schemes</td>
                  <td><a href="{{ route('course_managed_scheme', $course->id ) }}">{{ __($course->total_schemes) }} {{ __(str_plural('scheme', $course->total_schemes)) }}</a></td>
                </tr>
                <tr>
                  <td>No of Items</td>
                  <td><a href="{{ route('course_managed_scheme', $course->id ) }}">{{ __($course->total_schemes) }} {{ __(str_plural('item', $course->total_item)) }}</a></td>
                </tr>
                <tr>
                  <td>Status</td>
                  <td>{{ __(title_case($course->_status->description))}}</td>
                </tr>
                <tr>
                  <td>Date Created</td>
                  <td>{{ __($course->created_at->diffForHumans()) }}</td>
                </tr>
                <tr>
                  <td>Date Last Modified</td>
                  <td>{{ __($course->updated_at->diffForHumans()) }}</td>
                </tr>
                </tr>
              </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
  @component('coursemanaged.components.actions', ['course' => $course])

  @endcomponent
  </div>
  </div>
@endsection
