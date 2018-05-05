@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Courses Student Status</li>
  </ol>
  @if (session('status'))
    <div class="mx-auto alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-check-circle"></i> Course Student Status
    </div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th><input type="checkbox" name=""></th>
                <th>Course status</th>
                <th>Date created</th>
                <th>Date last modified</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($coursestudentstatus as $coursestudstat)
              <tr>
                <td><input type="checkbox" name=""></td>
                <td><a href=" {{ route('course_student_status_show', $coursestudstat->no ) }} ">{{ __(title_case($coursestudstat->description))}}</td>
                <td>{{ __($coursestudstat->created_at->diffForHumans()) }}</td>
                <td>{{ __($coursestudstat->updated_at->diffForHumans()) }}</td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <div class="row m-0">
              {{ $coursestudentstatus->links('vendor.pagination.bootstrap-4') }}
              </div>
            </tfoot>
          </table>
      </div>
    </div>
  </div>
</div>
@endsection
