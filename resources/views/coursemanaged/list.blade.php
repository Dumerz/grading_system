@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Courses Managed</li>
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
      <i class="fa fa-book"></i> Courses Managed
        <a href="{{ route('course_managed_add') }}" class="btn-sm btn-success float-right">
        <i class="fa fa-plus"></i> 
        {{ __('Add New') }}
        </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>SN.</th>
                <th>Course Name</th>
                <th class="text-center">Ratees</th>
                <th class="text-center">Periods</th>
                <th class="text-center">Schemes</th>
                <th class="text-center">Items</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
            @php
              $i = $courses->firstItem();
            @endphp
            @foreach ($courses as $course)
              <tr>
                <td>{{ $i }}</td>
                <td><a href="{{ route('course_managed_show', $course->id) }}">{{ __(ucfirst($course->name))}}</a></td>
                 <td class="text-center"><a href="{{ route('course_managed_student', $course->id ) }}">{{ __($course->total_students) }}</a></td>
                 <td class="text-center"><a href="{{ route('course_managed_period', $course->id ) }}">{{ __($course->total_periods) }}</a></td>
                 <td class="text-center"><a href="{{ route('course_managed_scheme', $course->id ) }}">{{ __($course->total_schemes) }}</a></td>
                 <td class="text-center"><a href="">{{ __($course->total_item) }}</a></td>
                 <td>{{ __(title_case($course->_status->description))}}</td>
              </tr>
              @php
                $i++;
              @endphp
            @endforeach
            </tbody>
            <tfoot>
              <div class="row m-3">
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
