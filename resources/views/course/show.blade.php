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
    <li class="breadcrumb-item active">Show</li>
  </ol>
  @if (session('status'))
    <div class="mx-auto alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-user-circle"></i> Course
      <a href="{{ route('course_update', $course->id) }}" class="btn-sm btn-success float-right">
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
                <td>{{ __(title_case($course->description))}}</td>
              </tr>
              <tr>
                <td>Evaluator</td>
                <td><a href="{{ route('user_profile_show', $course->evaluator_user->id ) }}">{{ __(title_case($course->evaluator_user->name_full))}}</a></td>
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
@endsection
