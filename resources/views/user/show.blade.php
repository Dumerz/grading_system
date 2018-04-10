@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('user') }}">Users</a>
    </li>
    <li class="breadcrumb-item active">Show</li>
  </ol>
  @if (session('status'))
  <div class="alert alert-success">
      {{ session('status') }}
  </div>
  @endif
  @if (session('warning'))
  <div class="alert alert-warning">
      {{ session('warning') }}
  </div>
  @endif
  <div class="row">
    <div class="col-lg-9 col-md-12 mb-3">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-user"></i> User
          <a href="{{ route('user_update', $user->id) }}" class="btn-sm btn-success float-right">
          <i class="fa fa-edit"></i> 
          {{ __('Update') }}
          </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
              <table class="table" id="dataTable" width="100%" cellspacing="0">
                <tbody>
                  <tr>
                    <td>Full Name</td>
                    <td>{{ __(title_case($user->name_full))}}</td>
                  </tr>
                  <tr>
                    <td>Last Name</td>
                    <td>{{ __(title_case($user->name_last))}}</td>
                  </tr>
                  <tr>
                    <td>First Name</td>
                    <td>{{ __(title_case($user->name_first))}}</td>
                  </tr>
                @if(!empty($user->name_middle))
                  <tr>
                    <td>Middle Name</td>
                    <td>{{ __(title_case($user->name_middle))}}</td>
                  </tr>
                @endif
                @if(!empty($user->name_suffix))
                  <tr>
                    <td>Name Suffix</td>
                    <td>{{ __(title_case($user->name_suffix))}}</td>
                  </tr>
                @endif
                  <tr>
                    <td>Gender</td>
                    <td>{{ __(title_case($user->gender))}}</td>
                  </tr>
                  <tr>
                    <td>Birth Date</td>
                    <td>{{ __($user->date_birth->toFormattedDateString())}}</td>
                  </tr>
                  <tr>
                    <td>Age</td>
                    <td>{{ __($user->age)}}</td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td>{{ __($user->email)}}</td>
                  </tr>
                  <tr>
                    <td>Usertype</td>
                    <td><a href="{{ route('usertype_show', $user->typeuser->no) }}">{{ __(title_case($user->typeuser->description))}}</a></td>
                  </tr>
                  <tr>
                    <td>Userstatus</td>
                    <td><a href="{{ route('userstatus_show', $user->statususer->no) }}">{{ __(title_case($user->statususer->description))}}</a></td>
                  </tr>
                  <tr>
                    <td>Date Created</td>
                    <td>{{ __($user->created_at->diffForHumans()) }}</td>
                  </tr>
                  <tr>
                    <td>Date Last Modified</td>
                    <td>{{ __($user->updated_at->diffForHumans()) }}</td>
                  </tr>
                  </tr>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  @component('user.components.actions', ['user' => $user])

  @endcomponent
  </div>
</div>
@endsection
