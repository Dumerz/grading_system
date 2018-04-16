@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Courses</li>
  </ol>
  @if (session('status'))
    <div class="mx-auto alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-book"></i> Courses
        <a href="{{ route('course_add') }}" class="btn-sm btn-success float-right">
        <i class="fa fa-user-plus"></i> 
        {{ __('Add New') }}
        </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th><input type="checkbox" name=""></th>
                <th>Course Name</th>
                <th>Rater</th>
                <th>Status</th>
                <th>Date created</th>
                <th>Date last modified</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($courses as $course)
              <tr>
                <td><input type="checkbox" name=""></td>
                <td><a href="{{ route('course_show', $course->id) }}">{{ __(title_case($course->name))}}</a></td>
                 <td><a href="{{ route('user_profile_show', $course->evaluator_user->id) }}">{{ __(title_case($course->evaluator_user->name_full))}}</a></td>
                 <td>{{ __(title_case($course->_status->description))}}</td>
                <td>{{ $course->created_at->diffForHumans() }}</td>
                <td>{{ $course->updated_at->diffForHumans() }}</td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <div class="row m-0">
              {{ $courses->links('vendor.pagination.bootstrap-4') }}
              </div>
            </tfoot>
          </table>
        </div>
    </div>
  </div>
</div>
@endsection
