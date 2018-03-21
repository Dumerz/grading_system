@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
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
                    <td>{{ __($user->name_last) }}, {{ __($user->name_first) }}
                    @isset($user->name_middle)
                    {{ __($user->name_middle) }} 
                    @endisset
                    @isset($user->name_suffix)
                    {{ __($user->name_suffix) }}
                    @endisset</td>
                    <td>{{ __(title_case($user->gender))}}</td>
                    <td>{{ __($user->typeuser->description)}}</td>
                    <td>{{ __($user->date_birth)}}</td>
                    <td>{{ $user->created_at}}</td>
                    <td>{{ $user->updated_at}}</td>
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                  {{ $users->links('vendor.pagination.bootstrap-4') }}
                </tfoot>
              </table>
            </div>
        </div>
      </div>
</div>
@endsection
