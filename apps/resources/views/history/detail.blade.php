@extends('layouts.app')

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
        <title>Apotek Lamganda</title>
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            nav {
                box-shadow: 4px 4px 50px rgba(145, 145, 145, 0.2);
                padding-bottom: 20px !important;
                padding-top: 20px !important;
                z-index: 99 !important;
                background: white;
            }

            .navbar-nav > li{
                margin-left: 30px;
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
                <a href="/status" class="btn btn-outline-danger mb-3"> <- Kembali</a>

                <h1 class="title-text">Detail Pesanan ID {{$orders[0]['order']['id']}}</h1>
                <p class="title-desc mt-1">Riwayat Pesanan di Apotek Lamganda</p>
            </div>

            <div>
                @if($orders[0]['order']['status'] == 'Checking Admin')
                    <td class="align-middle text-center"><button disabled class="btn btn-outline-success">Menunggu Disetujui</button></td>
                @elseif($orders[0]['order']['status'] == 'Ditolak Admin' || $orders[0]['order']['status'] == 'Ditolak Karyawan')
                    <td class="align-middle text-center"><button disabled class="btn btn-outline-danger">Ditolak</button></td>
                @elseif($orders[0]['order']['status'] == 'Dibatalkan Customer')
                    <td class="align-middle text-center"><button disabled class="btn btn-outline-danger">Dibatalkan Customer</button></td>
                @elseif($orders[0]['order']['status'] == 'Disetujui Admin' || $orders[0]['order']['status'] == 'Disetujui Karyawan')
                    <td class="align-middle text-center"><button disabled class="btn btn-outline-primary">Disetujui</button></td>
                @else
                    <td class="align-middle text-center"><button disabled class="btn btn-outline-success">{{$orders[0]['order']['status']}}</button></td>
                @endif
                @if($orders[0]['order']['status'] == 'Berhasil' || $orders[0]['order']['status'] == 'Berhasil Diambil')
                    <a target="_blank" rel="noopener noreferrer" href="/generate-pdf?order_id={{$orders[0]['order']['id']}}"><button class="btn btn-primary">Download Invoice</button></a>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                        <th scope="col">Nama Obat</th>
                        <th class="text-center" scope="col">Gambar</th>
                        <th class="text-center" scope="col">Kuantitas</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $cart)
                        <tr>
                            <td class="align-middle">{{ $cart['medicine']['name'] }}</td>
                            <td class="text-center"><img src="{{ $cart['medicine']['image'] }}" alt="{{ $cart['medicine']['image'] }}" width=100></td>
                            <td class="align-middle text-center">{{ $cart['quantity'] }}</td>
                            <td class="align-middle">@currency($cart['medicine']['price'])</td>
                            <td class="align-middle">@currency($cart['medicine']['price'] * $cart['quantity'])</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan=4>Sub Total</td>
                            <td colspan=1>@currency($cart['order']['total'])</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
