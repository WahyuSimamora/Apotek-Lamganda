@extends('layouts.master') @section('content') <head>
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

        .navbar-nav>li {
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
            <a href="/dashboard/medicine-management" class="btn btn-outline-danger mb-3"> <- Kembali</a>
            <h1 class="title-text">Tambah Obat</h1>
            <p class="title-desc mt-1">Menambahkan Obat di Apotek Lamganda</p>
        </div>
    </div>
    <form method="POST" action="/dashboard/medicine-management/store" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="code" class="form-label">Kode Obat</label>
                        <input required type="text" class="form-control" name="code" id="code">
                        @if (\Session::has('medicine_validation'))
                            <div class="invalid-error" style="color:red;">
                                Kode Obat Sudah Ada
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Obat</label>
                        <input required type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok</label>
                        <input required type="number" name="stock" class="form-control" id="stock">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input required type="file" name="image" class="form-control" id="image">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="unit" class="form-label">Satuan/Unit</label>
                    <select required class="form-select" name="unit" id="unit">
                        <option value="">Pilih Satuan</option>
                        <option value="strip">Strip</option>
                        <option value="botol">Botol</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Harga Satuan</label>
                    <input required type="number" name="price" class="form-control" id="price">
                </div>
                <div class="mb-3">
                    <label for="expired_date" class="form-label">Tanggal Expired</label>
                    <input required type="date" name="expired_date" class="form-control" id="expired_date">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea required style="height: 200px" type="text" name="description" class="form-control" id="description"></textarea>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6">
                <button type="submit" class="btn btn-success">Create</button>
            </div>
        </div>
    </form>
</div>
<script>
    var urlParams = new URLSearchParams(window.location.search);
    let queryString = urlParams.get('status');
    // Find the option in the select that has the same value as
    // the query string value and make it be selected
    document.getElementById("filter-status").querySelector("option[value='" + queryString + "']").selected = true;
</script> @endsection