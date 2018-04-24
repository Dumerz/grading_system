@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('course_managed_show', $course->id) }}">Course</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('course_managed_period', $period->id) }}">Period</a>
    </li>
    <li href="" class="breadcrumb-item active">Add Item</li>
  </ol>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-calendar"></i> <a href="{{ route('course_managed_show', $course->id) }}">{{ __($course->name) }}</a> / <a href="{{ route('course_managed_period', $period->id) }}">{{ __($period->description) }}</a> / Add Item
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('course_managed_period_item_hadle_add', ['course' => $course->id, 'period' => $period->id] ) }}">
      @csrf
        <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Item Description') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="text" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" value="{{ old('description') }}" autofocus required>
              @if ($errors->has('description'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('description') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="usertype" class="col-md-4 col-form-label text-md-right">{{ __('Scheme') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <select class="form-control {{ $errors->has('scheme') ? ' is-invalid' : '' }}" name="scheme" id="scheme" required>
                @foreach ($schemes as $scheme)
                  <option value="{{ __($scheme->id) }}"
                    @if (old('scheme') == $scheme->id)
                        selected 
                    @endif
                   >{{ __(title_case($scheme->description)) }}</option>
                @endforeach
              </select>
              @if ($errors->has('scheme'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('scheme') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Max Score') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="number" class="form-control {{ $errors->has('max_score') ? ' is-invalid' : '' }}" name="max_score" id="max_score" value="{{ old('max_score') }}" required>
              @if ($errors->has('max_score'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('max_score') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-success">
                    {{ __('Add New Item') }}
                </button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
