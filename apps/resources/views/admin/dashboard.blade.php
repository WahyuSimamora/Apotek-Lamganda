@extends('layouts.master')

@section('content')
<div class="container">
    @if (count($notification) < 1)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} {{ auth()->user()->role }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5>{{ auth()->user()->name }}</h5>
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    @else
    @foreach ($notification as $notif)
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card" style="border: 1px solid red;">
                <div class="card-header" style="border-bottom: 1px solid red; background-color: red !important; color: white;">{{ __('Notifikasi Stok Obat') }}</div>

                <div class="card-body">
                    <h5>STOK HAMPIR HABIS!!</h5>
                    <p>Stok obat {{ $notif->medicine_name }} tersisa {{ $notif->medicine_stock }}</p>
                    <a href="/dashboard/medicine-management/{{ $notif->medicine_id }}">Update Stok</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @endif
</div>
@endsection
