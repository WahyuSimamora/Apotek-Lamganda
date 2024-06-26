@extends('layouts.master')

@section('content')
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <title>Apotek Lamganda</title>
        <style>
            tr:hover {
                background: #f4f4f4;
            }
            body {
                font-family: 'Inter', sans-serif;
            }

            .title-text {
                font-family: 'Playfair Display', serif;
                font-size: 3rem;
            }
            .title-desc {
                color: #848484;
                font-size: 1.1em;
            }
        </style>
    </head>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="title">
                <h1 class="title-text">Manajemen Pesanan</h1>
                <p class="title-desc mt-1">Manajemen Pesanan Apotek Lamganda</p>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <div class="col-md-6">
                <form action="/dashboard/order-management/search" method="GET">
                    <div class="input-group mb-3 mt-2">
                        <input class="i-search" type="text" name="keyword" placeholder="Cari nama pembeli" value="{{ request()->input('keyword') }}">
                        <input type="submit" class="btn btn-outline-secondary" value="Cari" style="border: 1px solid #D0D0D0;"/>
                    </div>
                </form>
            </div>

            <div>
                <form action="/dashboard/order-management/search" method="GET">
                    <select onchange="this.form.submit()" class="form-select" id="filter-status" name="status" aria-label="Default select example">
                        <option value= "" >Filter Status</option>
                        <option value="Checking Admin">Menunggu Disetujui</option>
                        <option value="Ditolak Admin">Ditolak Admin</option>
                        <option value="Ditolak Karyawan">Ditolak Karyawan</option>
                        <option value="Disetujui Admin">Disetujui Admin</option>
                        <option value="Disetujui Karyawan">Disetujui Karyawan</option>
                        <option value="Dibatalkan Customer">Dibatalkan Customer</option>
                    </select>
                </form>

                {{-- <div class="flex">
                    <form action="/dashboard/order-management/search" method="GET">
                        <div class="input-group mb-3 mt-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Filter Tanggal</span>
                            </div>
                            <input type="text" name="daterange" style="border: 1px solid #cdcdcd; border-radius: 4px; width: 205px" />
                            <input type="submit" class="btn btn-primary" value="Filter" style="border: 1px solid #D0D0D0;"/>
                        </div>
                    </form>
                </div> --}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                        <th scope="col">ID Pesanan</th>
                        <th scope="col">Nama Pembeli</th>
                        <th class="text-center" scope="col">Total</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Tanggal Pembelian</th>
                        <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr onclick="window.location='/dashboard/order-management/{{ $order['id'] }}'" >
                            <td class="align-middle">{{ $order['id'] }}</td>
                            <td class="align-middle">{{ $order['user']['name'] }}</td>
                            <td class="text-center align-middle">@currency($order['total'])</td>
                            @if($order['status'] == 'Checking Admin')
                                <td class="align-middle text-center"><button disabled class="btn btn-outline-warning">Menunggu Disetujui</button></td>
                            @elseif($order['status'] == 'Ditolak Karyawan')
                                <td class="align-middle text-center"><button disabled class="btn btn-outline-danger">Ditolak Karyawan</button></td>
                            @elseif($order['status'] == 'Ditolak Admin')
                                <td class="align-middle text-center"><button disabled class="btn btn-outline-danger">Ditolak Admin</button></td>
                            @elseif($order['status'] == 'Dibatalkan Customer')
                                <td class="align-middle text-center"><button disabled class="btn btn-outline-danger">Dibatalkan Customer</button></td>
                            @else
                                <td class="align-middle text-center"><button disabled class="btn btn-outline-success">{{$order['status']}}</button></td>
                            @endif

                            <td class="align-middle text-center">{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                            <td class="align-middle text-center">
                                @if($order['status'] == 'Disetujui Admin' || $order['status'] == 'Disetujui Karyawan')
                                <a href="#" onclick="showConfirmation('/dashboard/order-management/taken/{{ $order['id'] }}')"><button class="btn btn-success">Telah Diambil</button></a>
                                @elseif($order['status'] == 'Checking Admin')
                                    <a href="#" onclick="showConfirmation('/dashboard/order-management/approve/{{ $order['id'] }}')"><button class="btn btn-primary">Setujui</button></a>
                                    <a href="#" onclick="showConfirmation('/dashboard/order-management/reject/{{ $order['id'] }}')"><button class="btn btn-danger">Tolak</button></a>
                                @else($order['status'] == 'Dibatalkan Karyawan' || $order['status'] == 'Dibatalkan Admin')
                                    <a><button disabled class="btn btn-danger">{{$order['status']}}</button></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @if(count($orders) < 1)
                        <tr>
                            <td colspan=8 class="text-center align-middle pt-5 pb-5"><h5>Pesanan Tidak Ditemukan</h5></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center" style="background: none;">
                {{$orders->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        function showConfirmation(url) {
        if (confirm("Apakah anda yakin?")){
        window.location.href = url;
    }

}

        $.noConflict();
        jQuery( document ).ready(function( $ ) {

        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    });

    </script>

@endsection
