@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('course_managed_show', $item->course) }}">Course Managed</a>
    </li>
    <li class="breadcrumb-item active">
      <a href="{{ route('course_managed_period', $item->period) }}">Periods</a>
    </li>
    <li href="" class="breadcrumb-item active">Show</li>
  </ol>
  @if (session('status'))
    <div class="mx-auto alert alert-success">
      {{ session('status') }}
    </div>
  @elseif ($errors->any())
    <div class="mx-auto alert alert-warning">
      {{ $errors->first() }}
    </div>
  @endif
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-calendar"></i> <a href="{{ route('course_managed_show', $item->course) }}">{{ __($item->_course->description) }}</a> / <a href="{{ route('course_managed_period', $item->course) }}"> {{ __($item->_period->description) }}</a> / <a href="{{ route('course_managed_period_show', ['course' => $item->course, 'period' => $item->period]) }}"> {{ __(title_case($item->description))}}</a> / Grade
      <a href="{{ route('course_managed_period_item_grader', ['course' => $item->course, 'period' => $item->period, 'item' => $item->id]) }}" class="btn-sm btn-success float-right">
      <i class="fa fa-check"></i> 
      {{ __('Grade Ratees') }}
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>SN.</th>
                <th>Name</th>
                <th>Score</th>
                <th>Max Score</th>
              </tr>
            </thead>
            <tbody>
            @php
              $i = $students->firstItem();
            @endphp
            @foreach ($students as $student)
              <tr>
                <td>{{ $i }}</td>
                <td><a href="{{ route('user_profile_show', $student->_user->id) }}">{{ __($student->_user->name_full) }}</a></td>
                  @php
                    $eval = 0;
                  @endphp
                @foreach ($evaluations as $evaluation)
                  @if ($evaluation->course_student == $student->id)
                    @php
                      $eval = 1;
                    @endphp
                  @endif
                @endforeach
                @if($eval == 1)
                <td>{{ $evaluation->score }}</td>
                @else
                <td>-</td>
                @endif
                <td>{{ $item->max_score }}</td>
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
