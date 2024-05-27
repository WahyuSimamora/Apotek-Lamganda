
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->
        <!-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Invoice - Apotek Lamganda </title>
    </head>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="title">
                <img width=160 src="https://res.cloudinary.com/sarjanalidi/image/upload/v1682090389/apotek/logo_2_olwzxq.png" alt="logo">

                <h1 class="title-text mt-3">Invoice Pemesanan Obat</h1>
                <p class="title-desc mt-1">Invoice Pemesanan di Apotek Lambanda</p>
            </div>
        </div>

        <table>
            <tr>
                <th colspan=4>Detail Pesanan</th>
            </tr>
            <tr>
                <td scope="col" colspan=3>ID Pesanan</td>
                <td class="text-center" scope="col">:</td>
                <td scope="col">{{ $orders[0]['order']['id'] }}</td>
            </tr>
            <tr>
                <td scope="col" colspan=3>Tanggal Pemesanan</td>
                <td class="text-center" scope="col">:</td>
                <td scope="col">{{ $orders[0]['order']['created_at'] }}</td>
            </tr>
            <tr>
                <td scope="col" colspan=3>Status</td>
                <td class="text-center" scope="col">:</td>
                <td scope="col">{{ $orders[0]['order']['status'] }}</td>
            </tr>
        </table>

        <br>
        <table>
            <tr>
                <th colspan=4>Detail Pembeli</th>
            </tr>
            <tr>
                <td scope="col" colspan=3>Nama Lengkap</td>
                <td class="text-center" scope="col">:</td>
                <td scope="col">{{ $orders[0]['user']['name'] }}</td>
            </tr>
            <tr>
                <td scope="col" colspan=3>Email</td>
                <td class="text-center" scope="col">:</td>
                <td scope="col">{{ $orders[0]['user']['email'] }}</td>
            </tr>
        </table>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                        <th scope="col">Nama Obat</th>
                        <th class="text-center" scope="col">Kuantitas</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $cart)
                        <tr>
                            <td class="align-middle">{{ $cart['medicine']['name'] }}</td>
                            <td class="align-middle text-center">{{ $cart['quantity'] }}</td>
                            <td class="align-middle">@currency($cart['medicine']['price'])</td>
                            <td class="align-middle">@currency($cart['medicine']['price'] * $cart['quantity'])</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan=3>Sub Total</td>
                            <td colspan=1>@currency($cart['order']['total'])</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>