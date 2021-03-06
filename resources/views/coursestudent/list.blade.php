@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('course_managed_show', $course->id) }}">Course Managed</a>
    </li>
    <li class="breadcrumb-item active">Student</li>
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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <form method="POST" action="{{ route('course_managed_student_handle_remove', $course->id) }}">
  @csrf
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-book"></i>  <a href="{{ route('course_managed_show', $course->id) }}">{{ __($course->name) }}</a> / Students
      <div class="btn-group float-right" role="group" aria-label="First group">
        <a href="{{ route('course_managed_student_grade', $course->id) }}" class="btn-sm btn-primary">
        <i class="fa fa-check"></i> 
        {{ __('Show Ratees Grade') }}
        </a> 
        <a href="{{ route('course_managed_student_add', $course->id) }}" class="btn-sm btn-success">
        <i class="fa fa-plus"></i> 
        {{ __('Enroll Ratee') }}
        </a> 
        <button type="submit" class=" btn btn-sm btn-danger">
        <i class="fa fa-times"></i> 
        {{ __('Unenroll Ratee') }}
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th><input type="checkbox"></th>
                <th>SN.</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Date created</th>
                <th>Date last modified</th>
              </tr>
            </thead>
            <tbody>
            @php
              $i = $students->firstItem();
            @endphp
            @foreach ($students as $student)
              <tr>
                <td><input type="checkbox" name="id[]" value="{{ $student->id }}"></td>
                <td>{{ $i }}</td>
                <td><a href="{{ route('user_profile_show', $student->_user->id) }}">{{ __($student->_user->name_full) }}</a></td>
                <td>{{ __(title_case($student->_user->gender))}}</td>
                <td>{{ __($student->_user->age) }}</td>
                <td>{{ $student->created_at->diffForHumans()}}</td>
                <td>{{ $student->updated_at->diffForHumans()}}</td>
              </tr>
              @php
                $i++;
              @endphp
            @endforeach
            </tbody>
            <tfoot>
              <div class="row m-0">
                <h6 class="pt-2">Showing item <strong>{{ $students->firstItem() }}</strong> to <strong>{{ $students->lastItem() }}</strong> of <strong>{{ $students->total() }}</strong> records</h6>
                {{ $students->links('vendor.pagination.bootstrap-4') }}
              </div>
            </tfoot>
          </table>
      </div>
    </div>
  </div>
  </form>
</div>
@endsection
