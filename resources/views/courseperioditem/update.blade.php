@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('course_managed_show', $item->course) }}">Course</a>
    </li>
    <li class="breadcrumb-item active">
      <a href="{{ route('course_managed_period', $item->course) }}">Periods</a>
    </li>
    <li href="" class="breadcrumb-item active">Update</li>
  </ol>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <div class="row">
  <div class="col-lg-9 col-md-12 mb-3">
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-calendar"></i> <a href="{{ route('course_managed_show', $item->course) }}">{{ __($item->_course->description) }}</a> / <a href="{{ route('course_managed_period', $item->course) }}"> {{ __($item->_period->description) }}</a> / <a href="{{ route('course_managed_period_show', ['course' => $item->course, 'period' => $item->period]) }}"> {{ __(title_case($item->description))}}</a> / Update Item
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('course_managed_period_item_handle_update', ['course' => $item->course, 'period' => $item->period, 'item' => $item->id]) }}">
      @csrf
        <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Item Description') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="text" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" value="{{ old('description')?old('description'):$item->description }}" autofocus required>
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
                @elseif (empty(old('scheme')) && $item->scheme == $scheme->id)
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
              <input type="number" class="form-control" id="max_score" value="{{ $item->max_score }}" required readonly>
                <div class="input-group-append">
                  <div class="input-group-text badge-success"><i class="fa fa-lock"></i></div>
                </div>
            </div>
          </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-success">
                    {{ __('Update Item') }}
                </button>
            </div>
        </div>
      </form>
    </div>
  </div>
  </div>
  </div>
</div>
@endsection
