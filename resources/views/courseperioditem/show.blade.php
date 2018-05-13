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
      <a href="{{ route('course_managed_period', $item->course) }}">Periods</a>
    </li>
    <li href="" class="breadcrumb-item active">Show</li>
  </ol>
  @if (session('status'))
    <div class="mx-auto alert alert-success">
      {{ session('status') }}
    </div>
  @endif
  <div class="row">
  <div class="col-lg-8 col-md-12 mb-3">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-calendar"></i> <a href="{{ route('course_managed_show', $item->course) }}">{{ __($item->_course->description) }}</a> / <a href="{{ route('course_managed_period', $item->course) }}"> {{ __($item->_period->description) }}</a> / <a href="{{ route('course_managed_period_show', ['course' => $item->course, 'period' => $item->period]) }}"> {{ __(title_case($item->description))}}</a> / Show
      <a href="{{ route('course_managed_period_item_update', ['course' => $item->course, 'period' => $item->period, 'item' => $item->id]) }}" class="btn-sm btn-success float-right">
          <i class="fa fa-edit"></i> 
          {{ __('Update') }}
          </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <tbody>
              <tr>
                <td>Description</td>
                <td>{{ __(title_case($item->description))}}</td>
              </tr>
              <tr>
                <td>Scheme</td>
                <td><a href="{{ route('course_managed_scheme_show', ['course' => $item->course, 'scheme' => $item->scheme]) }}">{{ __(title_case($item->_scheme->description))}}</a></td>
              </tr>
              <tr>
                <td>Period</td>
                <td><a href="{{ route('course_managed_period_show', ['course' => $item->course, 'period' => $item->period]) }}">{{ __(title_case($item->_period->description))}}</a></td>
              </tr>
              <tr>
                <td>Max Score</td>
                <td>{{ __($item->max_score) }}</td>
              </tr>
              <tr>
                <td>Date Created</td>
                <td>{{ __($item->created_at->diffForHumans()) }}</td>
              </tr>
              <tr>
                <td>Date Updated</td>
                <td>{{ __($item->updated_at->diffForHumans()) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
  </div>
  </div>
  @component('courseperioditem.components.actions', ['item' => $item])

  @endcomponent
  </div>
  </div>
@endsection
