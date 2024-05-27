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
                <h1 class="title-text">Riwayat Pesanan</h1>
                <p class="title-desc mt-1">Riwayat Pesanan di Apotek Lamganda</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                        <th scope="col">ID Pesanan</th>
                        <th class="text-center" scope="col">Total</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Tanggal Pemesanan</th>
                        <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td class="align-middle">{{ $order['id'] }}</td>
                            <td class="text-center">@currency($order['total'])</td>
                            @if($order['status'] == 'Checking Admin')
                                <td class="align-middle text-center"><button disabled class="btn btn-outline-warning">Menunggu Disetujui</button></td>
                            @elseif($order['status'] == 'Ditolak Admin' || $order['status'] == 'Ditolak Karyawan' || $order['status'] == 'Dibatalkan Customer')
                                <td class="align-middle text-center"><button disabled class="btn btn-outline-danger">{{ $order['status'] }}</button></td>
                            @elseif($order['status'] == 'Disetujui Admin' || $order['status'] == 'Disetujui Karyawan')
                                <td class="align-middle text-center"><button disabled class="btn btn-outline-primary">{{ $order['status'] }}</button></td>
                            @else
                                <td class="align-middle text-center"><button disabled class="btn btn-outline-success">Berhasil Diambil</button></td>
                            @endif
                            <td class="text-center">{{ $order['created_at'] }}</td>

                            @if($order['status'] == 'Checking Admin')
                                <td class="text-center">
                                    <a href="/order/reject/{{ $order['id'] }}"><button class="btn btn-danger">Batalkan</button></a>
                                    <a href="/order/{{ $order['id'] }}"><button class="btn btn-primary">Lihat Detail</button></a>
                                </td>
                            @else
                                <td class="text-center">
                                    <a href="/order/{{ $order['id'] }}"><button class="btn btn-primary">Lihat Detail</button></a>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                        @if(count($orders) < 1)
                            <tr>
                                <td colspan=8 class="text-center align-middle pt-5 pb-5"><h5>Belum Ada Pesanan</h5></td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
        <div class="d-flex justify-content-center" style="background: none;">
            {{$orders->links('pagination::bootstrap-4')}}
        </div>

    </div>
@endsection
