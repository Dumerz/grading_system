@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('course_managed') }}">Course Managed</a>
    </li>
    <li class="breadcrumb-item active">Update</li>
  </ol>
  <div class="row">
  <div class="col-lg-9 col-md-12 mb-3">
    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-briefcase"></i> Update Course Managed
        </div>
      <div class="card-body">
          <form method="POST" action="{{ route('course_managed_handle_update', $course->id) }}">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $course->id }}" readonly>
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                  <div class="input-group mb-2 mr-sm-2">
                    <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ old('name') ? old('name') : $course->name }}">
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
                  <input id="description" type="text" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') ? old('description') : $course->description }}" >
                  @if ($errors->has('description'))
                    <span class="invalid-feedback">
                      <strong>{{ $errors->first('description') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
              <div class="form-group row">
                <label for="name_suffix" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                <div class="col-md-6">
                  <div class="input-group mb-2 mr-sm-2">
                    <select class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" id="status" required>
                      @foreach ($coursestatus as $coursestat)
                        <option value="{{ __($coursestat->coursestatus_id) }}"
                          @if (old('status') == $coursestat->coursestatus_id)
                              selected 
                          @elseif (empty(old('status')) && $course->status == $coursestat->coursestatus_id)
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
    </div>
  </div>
  @component('coursemanaged.components.actions', ['course' => $course])

  @endcomponent
</div>
</div>
@endsection
