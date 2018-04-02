@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Users</li>
  </ol>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-user"></i> Users</div>
    <div class="card-body">
      <div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th><input type="checkbox" name=""></th>
                <th>Name</th>
                <th>Gender</th>
                <th>Usertype</th>
                <th>Age</th>
                <th>Date created</th>
                <th>Date last modified</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
              <tr>
                <td><input type="checkbox" name=""></td>
                <td><a href="{{ route('user_show', $user->id) }}">{{ __($user->name_full) }}</a></td>
                <td>{{ __(title_case($user->gender))}}</td>
                <td>{{ __(title_case($user->typeuser->description))}}</td>
                <td>{{ __($user->age) }}</td>
                <td>{{ $user->created_at->toFormattedDateString()}}</td>
                <td>{{ $user->updated_at->toFormattedDateString()}}</td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <div class="row m-0">
                <h6 class="pt-2">Showing item <strong>{{ $users->firstItem() }}</strong> to <strong>{{ $users->lastItem() }}</strong> of <strong>{{ $users->total() }}</strong> records</h6>
                {{ $users->links('vendor.pagination.bootstrap-4') }}
              </div>
            </tfoot>
          </table>
        </div>
    </div>
  </div>
</div>
@endsection
