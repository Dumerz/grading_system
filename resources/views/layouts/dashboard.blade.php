<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/fontawesome-all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/sb-admin.min.css') }}" rel="stylesheet" type="text/css">
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <a class="navbar-brand" href="{{route('home')}}">{{ config('app.name', 'Laravel') }}</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span class="nav-link-text">Dashboard</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
        <a class="nav-link nav-link-collapse" data-toggle="collapse" href="#collapseComponentsMyCourse">
          <i class="fas fa-fw fa-book"></i>
          <span class="nav-link-text">My Courses</span>
          <span class="float-right">
          <i class="fa fa-angle-right"></i>
          </span>
        </a>
          <ul class="sidenav-second-level collapse" id="collapseComponentsMyCourse">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('course_enrolled') }}">
                <i class="fa fa-fw fa-book"></i>
                <span class="nav-link-text">Courses Enrolled</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('course_enrolled') }}">
                <i class="fa fa-fw fa-book"></i>
                <span class="nav-link-text">Courses Grades</span>
              </a>
            </li>
          </ul>
      </li>
      @if (Auth::user()->usertype == "USRTYPE002" || Auth::user()->usertype == "USRTYPE003" )
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
        <a class="nav-link nav-link-collapse" data-toggle="collapse" href="#collapseComponentsCourse">
          <i class="fas fa-fw fa-book"></i>
          <span class="nav-link-text">Course Administration</span>
          <span class="float-right">
          <i class="fa fa-angle-right"></i>
          </span>
        </a>
          <ul class="sidenav-second-level collapse" id="collapseComponentsCourse">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('course_managed') }}">
                <i class="fa fa-fw fa-briefcase"></i>
                <span class="nav-link-text">Courses Managed</span>
              </a>
            </li>
          </ul>
      </li>
      @endif
      @if (Auth::user()->usertype == "USRTYPE003" )
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
        <a class="nav-link nav-link-collapse" data-toggle="collapse" href="#collapseComponentsSite">
          <i class="fas fa-fw fa-sliders-h"></i>
          <span class="nav-link-text">Site Administration</span>
          <span class="float-right">
          <i class="fa fa-angle-right"></i>
          </span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponentsSite">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user') }}">
              <i class="fa fa-fw fa-user"></i>
              <span class="nav-link-text">Users</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('usertype') }}">
              <i class="fa fa-fw fa-users"></i>
              <span class="nav-link-text">Usertypes</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('userstatus') }}">
              <i class="fa fa-fw fa-user-circle"></i>
              <span class="nav-link-text">Userstatus</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('course_status') }}">
              <i class="fa fa-fw fa-sticky-note"></i>
              <span class="nav-link-text">Course status</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('course_student_status') }}">
              <i class="fa fa-fw fa-check-circle"></i>
              <span class="nav-link-text">Course student status</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('course') }}">
              <i class="fa fa-fw fa-book"></i>
              <span class="nav-link-text">Course</span>
            </a>
          </li>
        </ul>
      </li>
      @endif
    </ul>
    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-right"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
      <canvas id="user-icon" width="40" height="40"></canvas>
      <a class="nav-link dropdown-toggle mr-lg-2" id="profile" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: inline-block; vertical-align: top;">
            {{ __(Auth::user()->name_full) }}
          </a>
          <div class="dropdown-menu bg-dark">
            <a class="dropdown-item nav-link bg-dark" href="{{ route('user_profile_show', Auth::user()->id) }}">My Profile</a>
            <a class="dropdown-item nav-link bg-dark" data-toggle="modal" data-target="#exampleModal">Logout</a>
          </div>
        </li>
    </ul>
  </div>
</nav>
<div class="content-wrapper">
    @yield('content')
</div>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">Logout</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
          </div>
        </div>
      </div>
    </div>
  <!-- Bootstrap core JavaScript-->
  <script src="{{url('/')}}/vendor/jquery/jquery.min.js"></script>
  <script src="{{url('/')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{url('/')}}/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{url('/')}}/js/sb-admin.min.js"></script>
    <script src="{{url('/')}}/js/avatar.js"></script>
</body>
</html>
