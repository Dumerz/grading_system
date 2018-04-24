@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      Course Enrolled
    </li>
    <li class="breadcrumb-item active">Courses</li>
  </ol>
  @if (session('status'))
    <div class="mx-auto alert alert-success">
      {{ session('status') }}
    </div>
  @elseif (session('warning'))
    <div class="mx-auto alert alert-warning">
      {{ session('warning') }}
    </div>
  @endif
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-book"></i> Course Enrolled
    </div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>SN.</th>
                <th>Course</th>
                <th>Rater</th>
                <th>Schemes</th>
                <th>Periods</th>
                <th>Status</th>
                <th>Date Enrolled</th>
                <th>Date last modified</th>
              </tr>
            </thead>
            <tbody>
            @php
              $i = $courses->firstItem();
            @endphp
            @foreach ($courses as $course)
              <tr>
                <td>{{ $i }}</td>
                <td><a href="">{{ __($course->_course->name) }}</a></td>
                <td><a href="{{ route('user_profile_show', $course->_course->evaluator_user->id) }}">{{ __($course->_course->evaluator_user->name_full) }}</a></td>
                <td>{{ __($course->_course->total_schemes) }}</td>
                <td>{{ __($course->_course->total_periods) }}</td>
                <td>{{ __(title_case($course->_status->description)) }}</td>
                <td>{{ $course->created_at->diffForHumans()}}</td>
                <td>{{ $course->updated_at->diffForHumans()}}</td>
              </tr>
              @php
                $i++;
              @endphp
            @endforeach
            </tbody>
            <tfoot>
              <div class="row m-0">
                <h6 class="pt-2">Showing item <strong>{{ $courses->firstItem() }}</strong> to <strong>{{ $courses->lastItem() }}</strong> of <strong>{{ $courses->total() }}</strong> records</h6>
                {{ $courses->links('vendor.pagination.bootstrap-4') }}
              </div>
            </tfoot>
          </table>
      </div>
    </div>
  </div>
</div>
@endsection
