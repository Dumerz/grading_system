@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('user') }}">Courses</a>
    </li>
    <li href="" class="breadcrumb-item active">Add</li>
  </ol>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-user-plus"></i> Add Course
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('course_handle_add') }}">
      @csrf
        <div class="form-group row">
          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name') }}" placeholder="Name" autofocus required>
              @if ($errors->has('name'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" rows="3" value="{{ old('description') }}" placeholder="Description"></textarea>
              @if ($errors->has('description'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('description') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="evaluator" class="col-md-4 col-form-label text-md-right">{{ __('Evaluator') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <select class="form-control {{ $errors->has('evaluator') ? ' is-invalid' : '' }}" name="evaluator" id="evaluator" required>
                @foreach ($evaluators as $evaluator)
                  <option value="{{ __($evaluator->id) }}"
                    @if (old('evaluator') == $evaluator->id)
                        selected 
                    @endif
                   >{{ __(title_case($evaluator->name_full)) }}</option>
                @endforeach
              </select>
              @if ($errors->has('evaluator'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('evaluator') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="name_suffix" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
          <div class="col-md-6">
            <div class="input-group mb-2 mr-sm-2">
              <select class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" id="status" required>
                @foreach ($coursestatus as $coursestat)
                  <option value="{{ __($coursestat->coursestatus_id) }}"
                    @if (old('coursestatus') == $coursestat->coursestatus_id)
                        selected 
                    @endif
                   >{{ __(title_case($coursestat->description)) }}</option>
                @endforeach
              </select>
              @if ($errors->has('status'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('status') }}</strong>
                </span>
              @endif
            </div>
          </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Add Course') }}
                </button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
