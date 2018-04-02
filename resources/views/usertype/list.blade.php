@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">UserTypes</li>
  </ol>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-user"></i> Usertypes</div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th><input type="checkbox" name=""></th>
                <th>Usertypes</th>
                <th>Date created</th>
                <th>Date last modified</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($usertypes as $usertype)
              <tr>
                <td><input type="checkbox" name=""></td>
                <td><a href="{{ route('usertype_show', $usertype->no) }}">{{ __(title_case($usertype->description))}}</td>
                <td>{{ $usertype->created_at->toFormattedDateString()}}</td>
                <td>{{ $usertype->updated_at->toFormattedDateString()}}</td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <div class="row m-0">
              {{ $usertypes->links('vendor.pagination.bootstrap-4') }}
              </div>
            </tfoot>
          </table>
        </div>
    </div>
  </div>
</div>
@endsection
