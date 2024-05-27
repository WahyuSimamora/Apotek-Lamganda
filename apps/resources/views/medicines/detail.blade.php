@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
        

        <div class="d-flex col-md-12">
            
            <div class="col-md-6">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                        <li class="breadcrumb-item"><a style="text-decoration: none; color: black; cursor: inherit;" href="#">{{$medicines->name}}</a></li>
                    </ol>
                </div>
                <img style="width: 100%; max-width: 500px" src="{{$medicines->image}}" alt="" srcset="">
            </div>
            <div class="col-md-6">
                <h1 class="mt-4">{{$medicines->name}}</h1>
                <h3>@currency($medicines['price'])</h3>
                <h6>Per {{$medicines->unit}}</h6>
                <h5 class="mt-4">Deskripsi</h5>
                <p>{{$medicines->description}}</p>

                <h5 class="mt-3">Tanggal Kadaluarsa</h5>
                <p>{{$medicines->expired_date}}</p>
                <h5 class="mt-3">Stok</h5>
                <p>{{$medicines->stock}}</p>
                <form action="/cart?medicine_id={{ $medicines->id }}&source=detail" method="post">
                    @csrf
                    <div class="d-flex justify-content-between align-items-center">
                                    <h5 style="margin:0;">Masukan Kuantitas</h5>
                                    <input
                                        style="width: 55px; text-align: 'center'; border: 1px solid #D3D3D3; border-radius: 4px; padding-left: 10px;"
                                        max="{{$medicines['stock']}}"
                                        min=1
                                        id="quantity"
                                        type="number"
                                        name="quantity"
                                        value="1"
                                        oninput="javascript: if (this.value.length > this.max) this.value = this.value.slice(0, this.max);validity.valid||(value='');"
                                    >
                                </div>
                    <a href=""><button class="btn-keranjang mt-4">Masukan Keranjang</button></a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
