@extends('layouts.dashboard')

@section('content')
<div class="container fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('home') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('userstatus') }}">Userstatus</a>
    </li>
    <li class="breadcrumb-item active">Update</li>
  </ol>
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-user-circle"></i> Userstatus Update 
      </div>
    <div class="card-body">
        <form method="POST" action="{{ route('userstatus_handle_update', $userstatus->no) }}">
          @csrf
          <input type="hidden" name="id" id="id" value="{{ $userstatus->no }}" readonly>
            <div class="form-group row">
              <label for="userstatus_id" class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label>
              <div class="col-md-6">
                <div class="input-group mb-2 mr-sm-2">
                  <input type="text" class="form-control" id="userstatus_id" value="{{ $userstatus->userstatus_id }}" readonly>
                  <div class="input-group-append">
                    <div class="input-group-text badge-success"><i class="fa fa-lg fa-lock"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
              <div class="col-md-6">
                <input id="description" type="text" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') ? old('description') : $userstatus->description }}" >
                @if ($errors->has('description'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('description') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="date_created" class="col-md-4 col-form-label text-md-right">{{ __('Date Created') }}</label>
              <div class="col-md-6">
                <div class="input-group mb-2 mr-sm-2">
                  <input id="date_created" type="text" class="form-control" value="{{ $userstatus->created_at->diffForHumans() }}" readonly>
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
                  <input id="date_updated" type="text" class="form-control" value="{{ $userstatus->updated_at->diffForHumans() }}" readonly>
                  <div class="input-group-append">
                    <div class="input-group-text badge-success"><i class="fa fa-lock"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>
@endsection
