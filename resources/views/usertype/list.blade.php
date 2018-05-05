@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Usertypes</li>
  </ol>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-users"></i> Usertypes</div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>SN.</th>
                <th>Usertypes</th>
                <th>No. of User</th>
                <th>Date created</th>
                <th>Date last modified</th>
              </tr>
            </thead>
            <tbody>
            @php
             $i = $usertypes->firstItem();
            @endphp
            @foreach ($usertypes as $usertype)
              <tr>
                <td>{{ $i }}</td>
                <td><a href="{{ route('usertype_show', $usertype->no) }}">{{ __(title_case($usertype->description))}}</td>
                <td>{{ $usertype->total_ratee }}</td>
                <td>{{ $usertype->created_at->diffForHumans() }}</td>
                <td>{{ $usertype->updated_at->diffForHumans() }}</td>
              </tr>
              @php
                $i++;
              @endphp
            @endforeach
            </tbody>
            <tfoot>
              <div class="row m-3">
              <h6 class="pt-2">Showing item <strong>{{ $usertypes->firstItem() }}</strong> to <strong>{{ $usertypes->lastItem() }}</strong> of <strong>{{ $usertypes->total() }}</strong> records</h6>
              {{ $usertypes->links('vendor.pagination.bootstrap-4') }}
              </div>
            </tfoot>
          </table>
        </div>
    </div>
  </div>
</div>
@endsection
