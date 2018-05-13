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
    <li class="breadcrumb-item">
      <a href="{{ route('course_managed_period', $course->id) }}">Period</a>
    </li>
    <li class="breadcrumb-item active">Item</li>
  </ol>
  @if (session('status'))
    <div class="mx-auto alert alert-success">
      {{ session('status') }}
    </div>
  @elseif (session('warning'))
    <div class="mx-auto alert alert-warning">
      {{ session('status') }}
    </div>
  @endif
    <div class="card mb-3">  
      <div class="card-header">
      <i class="fa fa-calendar"></i> <a href="{{ route('course_managed_show', $course->id) }}">{{ __($course->name) }}</a> / <a href="{{ route('course_managed_period',['course' => $course->id]) }}">Periods</a> / Items
        <a href="{{ route('course_managed_period_add', ['course' => $course->id]) }}" class="btn-sm btn-success float-right">
        <i class="fa fa-plus"></i> 
        {{ __('Add Period') }}
        </a>
      </div>
    </div>
  @foreach ($periods as $period)
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-calendar"></i> <a href="{{ route('course_managed_period_show', ['course' => $course->id, 'period' => $period->id]) }}">{{ __($period->description) }}</a>
        <a href="{{ route('course_managed_period_item_add', ['course' => $course->id, 'period' => $period->id]) }}" class="btn-sm btn-success float-right">
        <i class="fa fa-plus"></i> 
        {{ __('Add Item') }}
        </a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Scheme</th>
                  <th>Max Score</th>
                  <th>Date created</th>
                  <th>Date last modified</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($items as $item)
                 @if ($item->period == $period->id)
                 <tr>
                  <td><a href="{{ route('course_managed_period_item_show', ['course' => $item->course, 'period' => $item->period, 'item' => $item->id]) }}">{{ __($item->description) }}</a></td>
                  <td><a href="{{ route('course_managed_scheme_show', ['course' => $item->course, 'scheme' => $item->scheme]) }}">{{ __($item->_scheme->description) }}</a></td>
                  <td>{{ __($item->max_score) }}</td>
                  <td>{{ __($item->created_at->diffForHumans()) }}</td>
                  <td>{{ __($item->updated_at->diffForHumans()) }}</td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="{{ route('course_managed_period_item_grade', ['course' => $item->course, 'period' => $item->period, 'item' => $item->id]) }}" class="btn btn-success">Show Grades</a>
                      <a href="{{ route('course_managed_period_item_grader', ['course' => $item->course, 'period' => $item->period, 'item' => $item->id]) }}" class="btn btn-primary">Grade Ratees</a>
                    </div>
                  </td>
                 </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
@endforeach
  </div>
@endsection
