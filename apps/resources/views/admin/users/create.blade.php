@extends('layouts.master') @section('content') <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

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
            <a href="/dashboard/user-management" class="btn btn-outline-danger mb-3"> <- Kembali</a>

            <h1 class="title-text">Tambah User</h1>
            <p class="title-desc mt-1">Menambahkan User di Apotek Lamganda</p>
        </div>
    </div>
    <form method="POST" action="/dashboard/user-management/store" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input required type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">No HP</label>
                        <input required type="text" name="phone" class="form-control" id="phone" title="gunakan nomor yang valid (08xx) atau (628xx)" pattern="(08|62)\d{10,11}"
                                    oninput="
                                        this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
                                        if (this.value.length > 13) this.value = this.value.slice(0, 13);
                                        // validity.valid||(value='');
                                        if (typeof this.reportValidity === 'function') {
                                            this.reportValidity();
                                        }
                                    " >
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input required type="password" name="password" class="form-control" id="password">
                        <span id="eyePw" class="bi bi-eye-slash input-group-text" id="togglePassword" onclick="showPassword()"></span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select required class="form-select" name="role" id="role">
                        <option value="">Pilih Role</option>
                        <option value="customer">Customer</option>
                        <option value="karyawan">Karyawan</option>
                    </select>
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
    function showPassword() {
        var x = document.getElementById("password");
        var eye = document.getElementById("eyePw");

        if (x.type === "password") {
            x.type = "text";
            eye.className = "bi bi-eye input-group-text"
        } else {
            x.type = "password";
            eye.className = "bi bi-eye-slash input-group-text"
        }
    }
    var urlParams = new URLSearchParams(window.location.search);
    let queryString = urlParams.get('status');
    // Find the option in the select that has the same value as
    // the query string value and make it be selected
    document.getElementById("filter-status").querySelector("option[value='" + queryString + "']").selected = true;
</script>
@endsection
