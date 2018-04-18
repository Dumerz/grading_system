@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('course') }}">Course</a>
    </li>
    <li class="breadcrumb-item active">Update</li>
  </ol>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-user-circle"></i> Course Update
      </div>
    <div class="card-body">
        <form method="POST" action="">
          @csrf
          <input type="hidden" name="id" id="id" value="{{ $course->id }}" readonly>
            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
              <div class="col-md-6">
                <div class="input-group mb-2 mr-sm-2">
                  <input type="text" class="form-control" id="name" value="{{ $course->name }}" readonly>
                  <div class="input-group-append">
                    <div class="input-group-text badge-success"><i class="fa fa-lg fa-lock"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
              <div class="col-md-6">
                <input id="description" type="text" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') ? old('description') : $course->description }}" >
                @if ($errors->has('description'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('description') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="evaluator" class="col-md-4 col-form-label text-md-right">{{ __('Evaluator') }}</label>
              <div class="col-md-6">
                <input id="evaluator" type="text" class="form-control {{ $errors->has('evaluator') ? ' is-invalid' : '' }}" name="evaluator" value="{{ old('evaluator') ? old('evaluator') : $course->evaluator_user->name_full }}" >
                @if ($errors->has('evaluator'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('evaluator') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
              <div class="col-md-6">
                <input id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="{{ old('status') ? old('status') : title_case($course->_status->description) }}" >
                @if ($errors->has('status'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('status') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="date_created" class="col-md-4 col-form-label text-md-right">{{ __('Date Created') }}</label>
              <div class="col-md-6">
                <div class="input-group mb-2 mr-sm-2">
                  <input id="date_created" type="text" class="form-control" value="{{ $course->created_at->diffForHumans() }}" readonly>
                  <div class="input-group-append">
                    <div class="input-group-text badge-success"><i class="fa fa-lock"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="date_updated" class="col-md-4 col-form-label text-md-right">{{ __('Date Last Modified') }}</label>
              <div class="col-md-6">
                <div class="input-group mb-2 mr-sm-2">
                  <input id="date_updated" type="text" class="form-control" value="{{ $course->updated_at->diffForHumans() }}" readonly>
                  <div class="input-group-append">
                    <div class="input-group-text badge-success"><i class="fa fa-lock"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update Course') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
  @component('course.components.actions', ['user' => $user])

  @endcomponent
  </div>
</div>
@endsection
