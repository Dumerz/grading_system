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
    <li class="breadcrumb-item ">Student</li>
    <li class="breadcrumb-item active">Grade</li>
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
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-book"></i>  <a href="{{ route('course_managed_show', $course->id) }}">{{ __($course->name) }}</a> / Students / Grade
      <div class="btn-group float-right" role="group" aria-label="First group">
        <a href="{{ route('course_managed_student_add', $course->id) }}" class="btn-sm btn-success">
        <i class="fa fa-plus"></i> 
        {{ __('Enroll Ratee') }}
        </a> 
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>SN.</th>
                <th>Name</th>
                <th>Gender</th>
                @foreach ($periods as $period)
                <td>{{$period->description}}</td>
                @endforeach
                <th>Total Grade</th>
              </tr>
            </thead>
            <tbody>
            @php
              $i = $students->firstItem();

            @endphp
            @foreach ($students as $student)
              @php
                $final = 0;
              @endphp
              <tr>
                <td>{{ $i }}</td>
                <td><a href="{{ route('user_profile_show', $student->_user->id) }}">{{ __($student->_user->name_full) }}</a></td>
                <td>{{ __(title_case($student->_user->gender))}}</td>
                @foreach ($periods as $period)
                  @php
                    $x = 0;
                  @endphp
                  @foreach ($items as $item)
                    @foreach ($evaluations as $eval)
                      @php
                        if($eval->course_item == $item->id && $eval->course_student == $student->id && $item->period == $period->id){
                          $x = $x + $eval->score;
                        }
                      @endphp
                    @endforeach
                  @endforeach
                <td>{{ $x }}</td>
                @php
                  $final = $final + $x;
                @endphp
                @endforeach
                <td>{{$final}}</td>
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
</div>
@endsection
