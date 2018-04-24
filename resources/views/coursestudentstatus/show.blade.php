@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('course_student_status') }}">Courses student status</a>
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
      <i class="fa fa-book"></i> Course student status
      <a href="{{ route('course_student_status_update', $coursestudentstatus->no) }}" class="btn-sm btn-success float-right">
      <i class="fa fa-edit"></i> 
      {{ __('Update') }}
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <tbody>
              <tr>
                <td>ID</td>
                <td>{{ __($coursestudentstatus->coursestudentstatus_id)}}</td>
              </tr>
              <tr>
                <td>Description</td>
                <td>{{ __(title_case($coursestudentstatus->description))}}</td>
              </tr>
              <tr>
                <td>Date Created</td>
                <td>{{ __($coursestudentstatus->created_at->diffForHumans()) }}</td>
              </tr>
              <tr>
                <td>Date Last Modified</td>
                <td>{{ __($coursestudentstatus->updated_at->diffForHumans()) }}</td>
              </tr>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
  </div>
</div>
@endsection
