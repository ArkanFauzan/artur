@extends('layout.master_umkm')

@section('content')
    <main style="max-width: 950px" class="main">
        <div class="product">
            <div class="product-image">
                <img src="/img/product/{{$product['img']}}">
            </div>
            <div class="product-name">
                <h4>{{$product['name']}}</h4>
                <div class="star">
                    <img src="/img/star.png" width="15px"/>
                    <img src="/img/star.png" width="15px"/>
                    <img src="/img/star.png" width="15px"/>
                </div>
            </div>
            <div class="description">
                <p>{{$product['description']}}</p>
            </div>
            <div class="link">
                <a class="btn-ecommerce" href="{{$product['ecommerce']}}"><img src="/img/toko umkm.png" width="25px" height="25px"><p>Buy Now</p></a>
                <a class="btn-ig" href="{{$product['ig']}}"><img src="/img/ig umkm.png" width="25px" height="25px"><p>Try Product</p></a>
            </div>
        </div>
    </main>
@endsection