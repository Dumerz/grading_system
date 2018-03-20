@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
