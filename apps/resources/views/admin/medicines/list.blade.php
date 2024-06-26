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
                <h1 class="title-text">Manajemen Obat</h1>
                <p class="title-desc mt-1">Manajemen Obat Apotek Lamganda</p>
            </div>
            <div>
            <a href="/dashboard/medicine-management/create"><button class="btn btn-success">Tambah Obat</button></a>

            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <div class="col-md-6">
                <form action="/dashboard/medicine-management/search" method="GET">
                    <div class="input-group mb-3 mt-2">
                        <input class="i-search" type="text" name="keyword" placeholder="Cari Nama Obat" value="{{ request()->input('keyword') }}">
                        <input type="submit" class="btn btn-outline-secondary" value="Cari" style="border: 1px solid #D0D0D0;"/>
                    </div>
                </form>
            </div>

            <div>
                <form action="/dashboard/medicine-management/search" method="GET">
                    <div class="input-group mb-3 mt-2">
                        <input class="form-control" type="date" id="expired_date" name="expired_date" placeholder="Cari Nama Obat" value="{{ request()->input('expired_date') }}">
                        <input type="submit" class="btn btn-primary" value="Filter" style="border: 1px solid #D0D0D0;"/>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Kode Obat</th>
                        <th class="text-center" scope="col">Harga</th>
                        <th class="text-center" scope="col">Stok</th>
                        <th class="text-center" scope="col">Tanggal Kadaluarsa</th>
                        <th class="text-center" scope="col">Deskripsi</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medicines as $key=>$medicine)
                        <tr>
                            <td class="align-middle">{{ $medicine['name'] }}</td>
                            <td class="align-middle">{{ $medicine['code'] }}</td>
                            <td class="text-center align-middle">@currency($medicine['price'])</td>
                            <td class="text-center align-middle">{{ $medicine['stock'] }}</td>
                            <td class="text-center align-middle">{{ substr($medicine['expired_date'], 0, 10) }}</td>
                            <td style="white-space: nowrap; text-overflow:ellipsis; overflow: hidden; max-width:20px;" class="text-center align-middle">{{ $medicine['description'] }}</td>
                            @if($status[$key] == 'Expired')
                                <td id="expired_date-{{$medicine['id']}}" class="text-center align-middle"><button class="btn btn-outline-danger" disabled>{{ $status[$key] }}</button></td>
                            @else
                                <td id="expired_date-{{$medicine['id']}}" class="text-center align-middle"><button class="btn btn-outline-success" disabled>{{ $status[$key] }}</button></td>
                            @endif
                            <td class="text-center">
                                <a href="/dashboard/medicine-management/delete/{{ $medicine['id'] }}"onclick="confirmDelete()"><button class="btn btn-danger">Delete</button></a>
                                <a href="/dashboard/medicine-management/{{ $medicine['id'] }}"><button class="btn btn-primary">Edit</button></a>
                            </td>
                        </tr>
                        @endforeach
                        @if(count($medicines) < 1)
                        <tr>
                            <td colspan=8 class="text-center align-middle pt-5 pb-5"><h5>Obat Tidak Ditemukan</h5></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center" style="background: none;">
                {{$medicines->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(){
            return confirm('Apakah anda yakin untuk menghapus?');
        }
        var urlParams = new URLSearchParams(window.location.search);
        let queryString = urlParams.get('status');

        // Find the option in the select that has the same value as
        // the query string value and make it be selected
        document.getElementById("filter-status").querySelector("option[value='" + queryString + "']").selected = true;

    </script>
@endsection
