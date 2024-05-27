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
                <h1 class="title-text">Keranjang</h1>
                <p class="title-desc mt-1">Keranjang Belanja di Apotek Lamganda</p>
            </div>


        </div>

        <form action="/order" method="post">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                            <th></th>
                            <th scope="col">Nama Obat</th>
                            <th class="text-center" scope="col">Gambar</th>
                            <th class="text-center" scope="col">Kuantitas</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total</th>
                            <th class="text-center" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $cart)
                            <tr>
                                <td class="align-middle text-center"><input onchange="toggleCheckbox(this)" checked class="form-check-input" id="checkbox-s" type="checkbox" name="checkbox[]" value="{{$cart['id']}}"></td>
                                <td class="align-middle">{{ $cart['medicine']['name'] }}</td>
                                <td class="text-center"><img src="{{ $cart['medicine']['image'] }}" alt="{{ $cart['medicine']['image'] }}" width=100></td>
                                <td class="align-middle text-center">
                                    <input
                                        style="width: 55px; text-align: 'center'; border: 1px solid #D3D3D3; border-radius: 4px; padding-left: 10px;"
                                        max="{{$cart['medicine']['stock']}}"
                                        min=1
                                        id="quantity-{{ $cart['id'] }}"
                                        type="number"
                                        name="quantity[]"
                                        value="{{ $cart['quantity'] }}"
                                        onkeyup="updateTotal('<?php echo $cart['id']; ?>')"
                                        oninput="javascript: if (this.value.length > this.max) this.value = this.value.slice(0, this.max);validity.valid||(value='');"
                                    >
                                </td>
                                <td id="price-{{ $cart['id'] }}" class="align-middle">{{ $cart['medicine']['price'] }}</td>
                                <td id="total-{{ $cart['id'] }}" class="align-middle">{{ $cart['medicine']['price'] * $cart['quantity'] }}</td>
                                <td class="align-middle text-center">
                                    <a href="#"onclick="showConfirmation('cart/delete/{{$cart['id']}}')" class="btn btn-outline-danger">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($result) < 1)
                            <tr>
                                <td colspan=8 class="text-center align-middle pt-5 pb-5"><h5>Keranjang Masih Kosong</h5></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @csrf
            @if($result)
                <button onclick="checkData()" class="btn btn-success mt-3" id="btn-checkout" type="submit" name="checkout" >Checkout Sekarang</button>
            @endif
        </form>

    </div>
    <script>
        function showConfirmation(url) {
        if (confirm("Apakah Anda yakin untuk menghapus?")) {
            window.location.href = url;
        }
    }
        function toggleCheckbox(element) {
            var cb = document.getElementsByName('checkbox[]');
            var btn = document.getElementById('btn-checkout');

            var ln = 0;
            for(var i=0; i< cb.length; i++) {
                if(cb[i].checked)
                    ln++
            }

            btn.disabled = false;
            if(ln == 0) {
                btn.disabled = true;
            }
        }


        function updateTotal(row) {
            var quantity = parseInt(document.getElementById("quantity-" + row).value);
            var price = parseInt(document.getElementById("price-" + row).innerText);
            var btn = document.getElementById('btn-checkout');

            console.log(quantity, 'asdkna')
            btn.disabled = false;

            if(!quantity) {
                btn.disabled = true;
            }
            var total = quantity * price;

            document.getElementById("total-" + row).innerText = total;
        }
  </script>
@endsection
