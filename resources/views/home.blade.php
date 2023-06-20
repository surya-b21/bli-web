@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (Auth::user()->role_id == 1)
                            {{ __('You are logged in! You are Kasir') }}
                        @elseif (Auth::user()->role_id == 2)
                            {{ __('You are logged in! You are Admin Stock') }}
                        @elseif (Auth::user()->role_id == 3)
                            {{ __('You are logged in! You are Super Admin') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
