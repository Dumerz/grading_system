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
      <i class="fa fa-user-circle"></i> Userstatus</div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>SN.</th>
                <th>Userstatus</th>
                <th>Date created</th>
                <th>Date last modified</th>
              </tr>
            </thead>
            <tbody>
            @php
              $i = $userstatus->firstItem();
            @endphp
            @foreach ($userstatus as $userstat)
              <tr>
                <td>{{ $i }}</td>
                <td><a href="{{ route('userstatus_show', $userstat->no) }}">{{ __(title_case($userstat->description))}}</td>
                <td>{{ __($userstat->created_at->diffForHumans()) }}</td>
                <td>{{ __($userstat->updated_at->diffForHumans()) }}</td>
              </tr>
              @php
                $i++;
              @endphp
            @endforeach
            </tbody>
            <tfoot>
              <div class="row m-3">
              <h6 class="pt-2">Showing item <strong>{{ $userstatus->firstItem() }}</strong> to <strong>{{ $userstatus->lastItem() }}</strong> of <strong>{{ $userstatus->total() }}</strong> records</h6>
              {{ $userstatus->links('vendor.pagination.bootstrap-4') }}
              </div>
            </tfoot>
          </table>
      </div>
    </div>
  </div>
</div>
@endsection
