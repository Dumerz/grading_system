@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
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
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('home') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-user"></i>
              </div>
              <div class="mr-5">{{ $usercount }} {{ str_plural('User', $usercount) }} found.</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('user') }}">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-users"></i>
              </div>
              <div class="mr-5">{{ $usertypecount }} {{ str_plural('Usertype', $usertypecount) }} found.</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('usertype') }}">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-user-circle"></i>
              </div>
              <div class="mr-5">{{ $userstatuscount }} Userstatus found.</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('userstatus') }}">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-book"></i>
              </div>
              <div class="mr-5">{{ $coursecount }} {{ str_plural('Course', $usertypecount) }} found.</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('course') }}">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-secondary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-briefcase"></i>
              </div>
              <div class="mr-5">{{ $coursemanagedcount }} {{ str_plural('Course', $coursemanagedcount) }} managed found.</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('course_managed') }}">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-dark o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-sticky-note"></i>
              </div>
              <div class="mr-5">{{ $coursestatuscount }} Course status found.</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="{{ route('course_status') }}">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-dark bg-light o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-check-circle"></i>
              </div>
              <div class="mr-5">{{ $coursestudentstatuscount }} Course student status found.</div>
            </div>
            <a class="card-footer text-dark clearfix small z-1" href="{{ route('course_student_status') }}">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
</div>
@endsection
