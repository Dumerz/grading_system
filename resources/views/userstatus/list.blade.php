@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Userstatus</li>
  </ol>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-user"></i> Userstatus</div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th><input type="checkbox" name=""></th>
                <th>Userstatus</th>
                <th>Date created</th>
                <th>Date last modified</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($userstatus as $userstat)
              <tr>
                <td><input type="checkbox" name=""></td>
                <td><a href="{{ route('userstatus_show', $userstat->no) }}">{{ __(title_case($userstat->description))}}</td>
                <td>{{ $userstat->created_at->toFormattedDateString()}}</td>
                <td>{{ $userstat->updated_at->toFormattedDateString()}}</td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <div class="row m-0">
              {{ $userstatus->links('vendor.pagination.bootstrap-4') }}
              </div>
            </tfoot>
          </table>
        </div>
    </div>
  </div>
</div>
@endsection
