@extends('layout.master_umkm')

@section('content')
    <main class="main">
        <div class="our-umkm">
            {{-- untuk style merefers ke umkm karena tampilannya sama --}}
            <h1>Our Product</h1>
            <product-list></product-list>
        </div>
    </main>
@endsection