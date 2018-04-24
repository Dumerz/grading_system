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
    <li class="breadcrumb-item active">Periods</li>
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
        <i class="fa fa-calendar"></i> <a href="{{ route('course_managed_show', $course->id) }}">{{ __($course->name) }}</a> / Periods
        <a href="{{ route('course_managed_period_add', $course->id) }}" class="btn-sm btn-success float-right">
        <i class="fa fa-plus"></i> 
        {{ __('Add Period') }}
        </a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>SN.</th>
                  <th>Period</th>
                  <th>Date created</th>
                  <th>Date last modified</th>
                </tr>
              </thead>
              <tbody>
            @php
              $i = $periods->firstItem();
            @endphp
              @foreach ($periods as $period)
                <tr>
                  <td>{{ __($loop->iteration) }}</td>
                  <td><a href="{{ route('course_managed_period_show', ['course' => $course->id, 'period' => $period->id]) }}"> {{ __(title_case($period->description))}}</a></td>
                  <td>{{ __($period->created_at->diffForHumans()) }}</td>
                  <td>{{ __($period->updated_at->diffForHumans()) }}</td>
                </tr>
                @php
                  $i++;
                @endphp
              @endforeach
              </tbody>
              <tfoot>
                <div class="row m-3">
                <h6 class="pt-2">Showing item <strong>{{ $periods->firstItem() }}</strong> to <strong>{{ $periods->lastItem() }}</strong> of <strong>{{ $periods->total() }}</strong> records</h6>
                {{ $periods->links('vendor.pagination.bootstrap-4') }}
                </div>
              </tfoot>
            </table>
          </div>
      </div>
    </div>
  </div>
@endsection
